<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ShopCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }

    public function productcategoryview($id)
    {
        return view('admin.product.productcategory',[
            'products' => Product::where('shop_type', $id)->get(),
            'units' => Unit::all(),
            'brands' => Brand::all(),
            'shop_types' => $id,
        ]);
    }

    public function index()
    {
        return view('admin.product.index', [
            'shop_types' => ShopCategory::all(),
        ]);
    }

    public function show($id)
    {
        return view('admin.product.addproduct', [
            'shop_type' => $id,
            'subcategories' => SubCategory::where('shop_type',$id)->get(),
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $product = Product::create([
            'name' => $request->name,
            'product_coad' => $request->product_coad,
            'image' => $request->image,
            'vedio' => $request->video,
            'small_description' => $request->small_description,
            'long_description' => $request->long_description,
            'brand' => $request->brand,
            'unit' => $request->unit,
            'mrp' => $request->mrp,
            'buy_price' => $request->buy_price,
            'sell_price' => $request->sell_price,
            'qty' => $request->qty,
            'shop_type' => $request->shop_type,
            'subcategory' => $request->subcategory,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
        ]);

        if (request()->hasFile('image')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = 'product/' . $filename . '_' . Str::random(5) . '.' . $extension;
            // Upload Image
            Image::make($request->file('image'))->resize(700 ,700)->save('uploads/' . $fileNameToStore);
            Product::where('id', $product->id)->update(
                [
                    "image" => $fileNameToStore,
                ]
            );
        }
        if ($request->hasFile('slider_image')) {
            foreach ($request->file('slider_image') as $image) {
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = 'product_slider/' . $filename . '_' . Str::random(5) . '.' . $extension;
                Image::make($image)->resize(700, 700)->save('uploads/' . $fileNameToStore);
                $data[] = $fileNameToStore;
            }
            Product::where('id', $product->id)->update(
                [
                    "slider_image" => json_encode($data),
                ]
            );
        }
        return redirect(route('product.index'))->with('addsuccess', 'add successfully');
    }


    public function edit($id)
    {
        return view('admin.product.editproduct', [
            'product' => Product::where('id', $id)->first(),
            'units' => Unit::all(),
            'brands' => Brand::all(),
            'subcategories' => SubCategory::where('shop_type', $id)->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $product->update([
            'name' => $request->name,
            'product_coad' => $request->product_coad,
            'image' => $request->old_image,
            'slider_image' => $request->old_slider_image,
            'vedio' => $request->video,
            'small_description' => $request->small_description,
            'long_description' => $request->long_description,
            'brand' => $request->brand,
            'unit' => $request->unit,
            'mrp' => $request->mrp,
            'buy_price' => $request->buy_price,
            'sell_price' => $request->sell_price,
            'qty' => $request->qty,
            'shop_type' => $request->shop_type,
            'subcategory' => $request->subcategory,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
        ]);
        if ($request->hasFile('image')) {

            $product = Product::where('id', $request->id)->first();
            if ($request->old_image) {
                unlink('uploads/' . $request->old_image);
            }
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = 'product/' . $filename . '_' . Str::random(5) . '.' . $extension;
            // Upload Image
            Image::make($request->file('image'))->resize(700, 700)->save('uploads/' . $fileNameToStore);
            Product::where('id', $product->id)->update(
                [
                    "image" => $fileNameToStore,
                ]
            );
        }
        if ($request->hasFile('slider_image')) {
            foreach ($request->file('slider_image') as $image) {
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = 'product_slider/' . $filename . '_' . Str::random(5) . '.' . $extension;
                Image::make($image)->resize(700, 700)->save('uploads/' . $fileNameToStore);
                $data[] = $fileNameToStore;
            }
        }
        if ($request->slider_image) {

            if ($product->slider_image) {
                foreach (json_decode($product->slider_image) as $slider_image) {
                    unlink('uploads/' . $slider_image);
                }
            }
            $product->update([
                'slider_image' => json_encode($data),
            ]);
        }
        return back()->with('editsuccess', 'edit successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('softdeletesuccess', 'softdelete successfully');
    }

    public function productrestoreview()
    {
        return view('admin.product.restore', [
            'products' => Product::onlyTrashed()->get(),
        ]);
    }

    public function productrestore($id)
    {
        Product::withTrashed()->find($id)->restore();
        return redirect(route('product.index'))->with('restoresuccess', 'restore successfully');
    }

    public function forcedelete($id)
    {
        $product = Product::withTrashed()->where('id',$id)->first();
        if ($product->image) {
            unlink('uploads/' . $product->image);
        }
        if ($product->slider_image) {
            foreach (json_decode($product->slider_image) as $slider_image) {
                unlink('uploads/' . $slider_image);
            }
        }
        Product::withTrashed()->find($id)->forcedelete();
        return back()->with('forcedeletesuccess', 'forcedelete successfully');
    }

    public function active($id){
        Product::find($id)->update([
            'status' => 1
        ]);
        return back();
    }

    public function deactive($id){
        Product::find($id)->update([
            'status' => 0
        ]);
        return back();
    }

}
