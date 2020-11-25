<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Shop;
use App\Models\ShopType;
use Illuminate\Http\Request;
use App\Models\ShopAccountStatus;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ShopsController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop)
    {
        $this->authorize('view', $shop);

        $shop = $shop->load(['shopType', 'shopAccountStatus']);

        return view('dashboard/retailer/shops/index', compact([
            'shop'
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
        // $shop_account_status = ShopAccountStatus::where('name', ShopAccountStatus::UNVERIFIED_SHOP)->get();
        // dd($shop_account_status->toArray());
        // dd($request->all());

        $this->authorize('create', Shop::class);

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'email' => 'required|string|email|max:191',
            'phone_number' => 'required',
            'shop_type' => 'required|integer',
            'banner_image' => 'required|image|mimes:jpeg,png,bmp|max:2048',
            'max_food_time' => 'required|integer|between:1,60',
            'min_food_time' => 'required|integer|between:1,60',
        ]);

        // handle the image upload
		if ($request->hasFile('banner_image')) {

            $image = $request->file('banner_image');

            // getClientOriginalExtension - gives us the original extension: eg. png, jpg etc...
            $new_image_name = time(). '_' . mt_rand(1, 50) . '.' . $image->getClientOriginalExtension();
            
            // define path for the thumbnail image.
            $large_path = public_path('/uploads/shops/banner_images/large');
            $small_path = public_path('/uploads/shops/banner_images/small');
            
            // open an image file.
            $img = Image::make($image);
            $img2 = Image::make($image);
            
            // resize, then save to respective path.
            $img->resize(800, 600)->save($large_path . '/' . $new_image_name);
            $img2->resize(250, 188)->save($small_path . '/' . $new_image_name);
		}

        $shop = Shop::class;

        $shop_account_status = ShopAccountStatus::where('name', ShopAccountStatus::UNVERIFIED_SHOP)->get()->first();

        DB::transaction(function() use(&$shop, $request, $new_image_name, $shop_account_status){
           $shop = Shop::create([
                'name' => $request->name,
                'description' => $request->description,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'shop_type_id' => $request->shop_type,
                'banner_image' => $new_image_name,
                'logo_image' => 'default_logo.jpg',
                'average_preparation_time' => $request->min_food_time . '-' . $request->max_food_time,
                'is_available' => false, // should be set to false by default
                'shop_account_status_id' => $shop_account_status->id, // status unverified by default.
            ]);
            
            Auth::user()->shops()->attach($shop);
        }, 3);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'New Shop Created Successfully']);
        }
        
        return back()->with('success', 'New Shop Created Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $this->authorize('update', $shop);

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'email' => 'required|string|email|max:191',
            'phone_number' => 'required',
            'shop_type' => 'required|integer',
            'banner_image' => 'required|string',
            'logo_image' => 'required|string',
            'average_preparation_time' => 'required|string',
        ]);


        $shop->update([
            'name' => $request->name,
            'description' => $request->description,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'shop_type_id' => $request->shop_type,
            'banner_image' => $request->banner_image,
            'logo_image' => $request->logo_image,
            'average_preparation_time' => $request->average_preparation_time,
        ]);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Shop Updated']);
        }
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        // $this->authorize('update', $reply);

        $shop->delete();

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Shop Deleted']);
        }

        return back();
    }

}
