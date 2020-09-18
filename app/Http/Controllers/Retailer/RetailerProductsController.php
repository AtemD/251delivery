<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;
use Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RetailerProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop)
    {
        $this->authorize('view', $shop);
        
        // Get all the products of this shop
        $products = $shop->products()->with('section')->orderBy('name', 'asc')->paginate(15);
        $sections = $shop->sections()->get();

        // Authorize if the user is allowed to view products
        $this->authorize('view', $products->first());

        return view('dashboard/retailer/products/index', compact([
            'shop',
            'products',
            'sections'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Authorize that the user can create products
        $this->authorize('create', Product::class);

        // Retrieve the shop to determine if it exists
        $shop = Shop::findOrFail($request->shop);

        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        // Retrieve the sections of the given shop to later validate if the section belongs to the shop
        $shop_sections = $shop->sections->pluck('id')->toArray();

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'shop' => 'required|integer',
            'section' => 'required|integer|in:' . implode(',', $shop_sections),
            'image' => 'sometimes|nullable|image|mimes:jpeg,bmp|max:2048',
            'description' => 'required|string|max:255',
            'base_price' => 'required|integer',
            'availability' => 'required|integer',
        ]);

        // handle the image upload
		if ($request->hasFile('image')) {

            $image = $request->file('image');

            // getClientOriginalExtension - gives us the original extension: eg. png, jpg etc...
            $filename = time(). '_' . mt_rand(1, 50) . '.' . $image->getClientOriginalExtension();
            
            // define path for the thumbnail image.
            $thumb_path = public_path('/uploads/shops/products/thumbs');
            
            // open an image file.
            $img = Image::make($image);
            
            // resize, then save to respective path.
            $img->resize(86, 64)->save($thumb_path . '/' . $filename);
		} else {
            $filename = Product::PRODUCT_DEFAULT_IMAGE;
        }

        Product::create([
            'name' => $request->name,
            'shop_id' => $request->shop,
            'section_id' => $request->section,
            'image' => $filename,
            'description' => $request->description,
            'base_price' => $request->base_price,
            'is_available' => (bool)$request->availability,
        ]);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'New Product Created']);
        }
        
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop $shop 
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, Product $product)
    {
        // Authorize that the user can update products
        $this->authorize('update', $product);

        // Retrieve the shop to determine if it exists
        $shop = Shop::findOrFail($request->shop);

        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        // Retrieve the sections of the given shop to later validate if the section belongs to the shop
        $shop_sections = $shop->sections->pluck('id')->toArray();

        
        /**
         * The regex of base_price will hold for quantities like '12' or '12.5' or '12.05'
         * 1 or 2 decimal places allowed
         * dissalows something like .22 
         */
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'shop' => 'required|integer',
            'section' => 'required|integer|in:' . implode(',', $shop_sections),
            'image' => 'sometimes|nullable|image|mimes:jpeg,bmp|max:2048',
            'description' => 'required|string|max:255',
            'base_price' => 'required|regex:/^\d+(\.\d{1,2})?$/', // allows: 12, 12.5, 12.05, 1 or 2 decimal places; dissalows: .22 
            'availability' => 'required|integer',
        ]);

        // handle the image upload
		// getClientOriginalExtension - gives us the original extension: eg. png, jpg etc...
		if ($request->hasFile('image')) {

            $image = $request->file('image');

            $filename = time(). '_' . mt_rand(1, 50) . '.' . $image->getClientOriginalExtension();
            
            // define path for the thumbnail image.
            $thumb_path = public_path('/uploads/shops/products/thumbs');
            
            // open an image file.
            $img = Image::make($image);
            
            // resize, then save to respective path.
            $img->resize(86, 64)->save($thumb_path . '/' . $filename);

            // Get the path where the previous image was stored and delete it. 
            $old_image_path = public_path($product->image_path);
            if(\file_exists($old_image_path)){
                \unlink($old_image_path);
            }
            
		} else {
            $filename = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'shop_id' => $request->shop,
            'section_id' => $request->section,
            'image' => $filename,
            'description' => $request->description,
            'base_price' => $request->base_price,
            'is_available' => (bool)$request->availability,
        ]);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Product Updated']);
        }
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     *  @param \App\Models\Shop $shop
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, Product $product)
    {
        // Authorize that the user can update products
        $this->authorize('delete', $product);

        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        $product->delete();

        // Delete the products image from file storage
        $old_image_path = public_path($product->image_path);
        if(\file_exists($old_image_path)){
            \unlink($old_image_path);
        }

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Product Deleted Successfully']);
        }

        return back();
    }
}
