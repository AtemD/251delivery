<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class ShopImagesController extends Controller
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        // dd('hit');
        // dd($request->toArray());
        // Authorize that the user can update products
        // $this->authorize('update', $shop);

        $this->validate($request,[
            'image' => 'required|image|mimes:jpeg,png,bmp|max:2048',
        ]);

        if(!$request->hasFile('image')){
            return back()->with('error', 'No image file of name image found');
        }

        if(!$request->file('image')->isValid()){
            return back()->with('error', 'The file uploaded is invalid');
        }

        // handle the image upload 

        $image = $request->file('image');

        // getClientOriginalExtension - gives us the original extension: eg. png, jpg etc...
        $filename = time(). '_' . mt_rand(1, 50) . '.' . $image->getClientOriginalExtension();
        
        // define path for the large and thumbnail image.
        $large_path = public_path('/uploads/shops/banner_images/large');
        $thumb_path = public_path('/uploads/shops/banner_images/thumbs');
        
        // dd($large_path . ' small-path :' . $thumb_path);
        // open an image file.
        $img = Image::make($image->getRealPath());
        
        // resize, then save to respective path.
        $large_image = $img->resize(844, 633)->save($large_path . '/' . $filename);
        $small_image = $img->resize(86, 64)->save($large_path . '/' . $filename);

        $large_image->stream();
        $small_image->stream();

        // Store the image file name in the database
        $shop->banner_image = $filename;
        $shop->save();

        // Get the path where the previous image was stored and delete it. 
        $old_image_path = public_path($shop->banner_image_path);
        if(\file_exists($old_image_path)){
            \unlink($old_image_path);
        }
    
        return redirect()->route('retailer.shops.accounts.index', ['shop' => $shop])->with('success', 'Image Updated Successfully');
    }
}
