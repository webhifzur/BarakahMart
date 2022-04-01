<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }

    public function index()
    {
        return view('admin.subcategory.index', [
            'subcategories' => SubCategory::all(),
            'shopcategories' => ShopCategory::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'shop_type' => ['required'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $subcategory = SubCategory::create([
            'type' => $request->type,
            'shop_type' => $request->shop_type,
            'slug' => $request->type . '-' . Str::random(5),
            'image' => $request->image,
        ]);
        if (request()->hasFile('image')) {

            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = 'subcategory/' . $filename . '_' . Str::random(5) . '.' . $extension;
            // Upload Image
            Image::make($request->file('image'))->resize(252, 176)->save('uploads/' . $fileNameToStore);
            SubCategory::where('id', $subcategory->id)->update(
                [
                    "image" => $fileNameToStore,
                ]
            );
        }
        return back()->with('addsuccess', 'add successfully');
    }

    
    public function update(Request $request, SubCategory $subCategory)
    {
        SubCategory::where('id', $request->id)->update([
            'type' => $request->type,
            'shop_type' => $request->shop_type,
            'image' => $request->old_image,
        ]);
        if ($request->hasFile('image')) {
            if ($request->old_image) {
                unlink('uploads/' . $request->old_image);
            }
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = 'subcategory/' . $filename . '_' . Str::random(5) . '.' . $extension;
            // Upload Image
            Image::make($request->file('image'))->resize(252, 176)->save('uploads/' . $fileNameToStore);
            SubCategory::where('id', $request->id)->update(
                [
                    "image" => $fileNameToStore,
                ]
            );
        }
        return back()->with('editsuccess', 'edit successfully');
    }

   
    public function destroy(Request $request, SubCategory $subCategory)
    {
        SubCategory::where('id', $request->id)->delete();
        return back()->with('softdeletesuccess', 'softdelete successfully');
    
    }

    public function subcategoryview()
    {
        return view('admin.subcategory.deletedshopcategory', [
            'subcategories' => SubCategory::onlyTrashed()->get(),
            'shopcategories' => ShopCategory::all(),
        ]);
    }

    public function subcategoryrestore($id)
    {
        SubCategory::withTrashed()->find($id)->restore();
        return redirect(route('subcategory.index'))->with('restoresuccess', 'restore successfully');
    }

    public function forcedelete($id)
    {
        $subcategory = SubCategory::withTrashed()->where('id', $id)->first();
        if ($subcategory->image) {
            unlink('uploads/' . $subcategory->image);
        }
        SubCategory::withTrashed()->find($id)->forcedelete();
        return back()->with('forcedeletesuccess', 'forcedelete successfully');
    }
}
