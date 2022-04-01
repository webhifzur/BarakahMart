<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ShopCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }

    public function index()
    {
        return view('admin.shopcategory.index', [
            'shopcategories' => ShopCategory::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'icon_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048' ],
            'image' => ['required' ,'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048' ],
        ]);

        $shopcategory = ShopCategory::create([
            'type' => $request->type,
            'slug' => $request->type . '-' . Str::random(5),
            'icon_image' => $request->icon_image,
            'image' => $request->image,
        ]);
        if (request()->hasFile('icon_image')) {

            // Get filename with the extension
            $filenameWithExt = $request->file('icon_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('icon_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = 'category/' . $filename . '_' . Str::random(5) . '.' . $extension;
            // Upload Image
            Image::make($request->file('icon_image'))->resize(25, 25)->save('uploads/' . $fileNameToStore);
            ShopCategory::where('id', $shopcategory->id)->update(
                [
                    "icon_image" => $fileNameToStore,
                ]
            );
        }
        if (request()->hasFile('image')) {

            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = 'category/' . $filename . '_' . Str::random(5) . '.' . $extension;
            // Upload Image
            Image::make($request->file('image'))->resize(252, 176)->save('uploads/' . $fileNameToStore);
            ShopCategory::where('id', $shopcategory->id)->update(
                [
                    "image" => $fileNameToStore,
                ]
            );
        }
        return redirect(route('shop.category'))->with('addsuccess', 'add successfully');
    }

    public function shopcategoryedit(Request $request)
    {
        ShopCategory::find($request->id)->update([
            'type' => $request->type,
            'icon_image' => $request->icon_old_image,
            'image' => $request->old_image,
        ]);
        if ($request->hasFile('icon_image')) {
            if ($request->icon_old_image) {
                unlink('uploads/' . $request->icon_old_image);
            }
            // Get filename with the extension
            $filenameWithExt = $request->file('icon_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('icon_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = 'category/' . $filename . '_' . Str::random(5) . '.' . $extension;
            // Upload Image
            Image::make($request->file('icon_image'))->resize(25, 25)->save('uploads/' . $fileNameToStore);
            ShopCategory::where('id', $request->id)->update(
                [
                    "icon_image" => $fileNameToStore,
                ]
            );
        }
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
            $fileNameToStore = 'category/' . $filename . '_' . Str::random(5) . '.' . $extension;
            // Upload Image
            Image::make($request->file('image'))->resize(252, 176)->save('uploads/' . $fileNameToStore);
            ShopCategory::where('id', $request->id)->update(
                [
                    "image" => $fileNameToStore,
                ]
            );
        }
        return back()->with('editsuccess', 'edit successfully');
    }

    public function shopcategorydelete($id)
    {
        ShopCategory::find($id)->delete();
        return back()->with('softdeletesuccess', 'softdelete successfully');
    }

    public function shopcategoryrestoreview()
    {
        return view('admin.shopcategory.deletedshopcategory', [
            'shopcategories' => ShopCategory::onlyTrashed()->get(),
        ]);
    }

    public function shopcategoryrestore($id)
    {
        ShopCategory::withTrashed()->find($id)->restore();
        return redirect(route('shop.category'))->with('restoresuccess', 'restore successfully');
    }

    public function forcedelete($id)
    {
        $shopcategory = ShopCategory::withTrashed()->where('id', $id)->first();
        if ($shopcategory->icon_image) {
            unlink('uploads/' . $shopcategory->icon_image);
        }
        if ($shopcategory->image) {
            unlink('uploads/' . $shopcategory->image);
        }
        ShopCategory::withTrashed()->find($id)->forcedelete();
        return back()->with('forcedeletesuccess', 'forcedelete successfully');
    }
}
