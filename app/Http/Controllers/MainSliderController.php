<?php

namespace App\Http\Controllers;

use App\Models\MainSlider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MainSliderController extends Controller
{
    public function index(){
        return view('admin.mainslider.index',[
            'sliders' => MainSlider::latest()->get(),
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5048'],
        ]);

        $mainslider = MainSlider::create([
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
            $fileNameToStore =$filename . '_' . Str::random(5) . '.' . $extension;
            // Upload Image
            Image::make($request->file('image'))->resize(1100, 400)->save('uploads/slider/' . $fileNameToStore);
            MainSlider::where('id', $mainslider->id)->update(
                [
                    "image" => $fileNameToStore,
                ]
            );
        }
        return back()->with('addsuccess', 'add successfully');
    }


    public function delete($id)
    {
        MainSlider::find($id)->delete();
        return back()->with('softdeletesuccess', 'softdelete successfully');
    }

    public function restoreview()
    {
        return view('admin.mainslider.deletedslider', [
            'sliders' => MainSlider::onlyTrashed()->get(),
        ]);
    }

    public function sliderrestore($id)
    {
        MainSlider::withTrashed()->find($id)->restore();
        return back()->with('restoresuccess', 'restore successfully');
    }

    public function forcedelete($id)
    {
        $mainslider = MainSlider::withTrashed()->where('id', $id)->first();
        if ($mainslider->image) {
            unlink('uploads/slider/' . $mainslider->image);
        }
        MainSlider::withTrashed()->find($id)->forcedelete();
        return back()->with('forcedeletesuccess', 'forcedelete successfully');
    }
}
