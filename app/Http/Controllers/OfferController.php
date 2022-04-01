<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class OfferController extends Controller
{
    public function index()
    {
        return view('admin.offer.index', [
            'offers' => Offer::latest()->get(),
            'products' => Product::where('status',1)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product' => ['required'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5048'],
        ]);

        $offer = Offer::create([
            'product_id' => $request->product,
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
            $fileNameToStore = 'offer/' . $filename . '_' . Str::random(5) . '.' . $extension;
            // Upload Image
            Image::make($request->file('image'))->resize(320, 180)->save('uploads/' . $fileNameToStore);
            Offer::where('id', $offer->id)->update(
                [
                    "image" => $fileNameToStore,
                ]
            );
        }
        return back()->with('addsuccess', 'add successfully');
    }

    public function delete($id)
    {
        Offer::find($id)->delete();
        return back()->with('softdeletesuccess', 'softdelete successfully');
    }

    public function restoreview()
    {
        return view('admin.offer.deleted', [
            'offers' => Offer::onlyTrashed()->get(),
        ]);
    }

    public function offerrestore($id)
    {
        Offer::withTrashed()->find($id)->restore();
        return back()->with('restoresuccess', 'restore successfully');
    }

    public function forcedelete($id)
    {
        $offer = Offer::withTrashed()->where('id', $id)->first();
        if ($offer->image) {
            unlink('uploads/' . $offer->image);
        }
        Offer::withTrashed()->find($id)->forcedelete();
        return back()->with('forcedeletesuccess', 'forcedelete successfully');
    }
}
