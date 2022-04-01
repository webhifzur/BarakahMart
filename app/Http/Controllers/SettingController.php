<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function index(){
        return view('admin.setting.index',[
            'setting' => Setting::first(),
        ]);
    }

    public function update(Request $request){

        $request->validate([
            'c_title' => ['required',],
            'p_title' => ['required',],
            'p_subtitle' => ['required',],
            'offer_title' => ['required',],
            'footer_description' => ['required',],
            'phone_one' => ['required',],
            'whatsapp' => ['required'],
            'facebook' => ['required'],
        ]);

        Setting::where('id', $request->setting_id)->update([
            'c_title' => $request->c_title,
            'p_title' => $request->p_title,
            'p_subtitle' => $request->p_subtitle,
            'offer_title' => $request->offer_title,
            'footer_description' => $request->footer_description,
            'phone_one' => $request->phone_one,
            'phone_two' => $request->phone_two,
            'whatsapp' => $request->whatsapp,
            'facebook' => $request->facebook,
        ]);
        $setting = Setting::where('id', $request->setting_id)->first();
        if (request()->hasFile('menu_logo')) {
            if ($setting->menu_logo) {
                unlink('uploads/' . $setting->menu_logo);
            }

            // Get filename with the extension
            $filenameWithExt = $request->file('menu_logo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('menu_logo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = 'setting/' . $filename . '_' . Str::random(5) . '.' . $extension;
            // Upload Image
            Image::make($request->file('menu_logo'))->resize(200, 65)->save('uploads/' . $fileNameToStore);
            Setting::where('id', $request->setting_id)->update(
                [
                    "menu_logo" => $fileNameToStore,
                ]
            );
        }
        if (request()->hasFile('footer_logo')) {
            if ($setting->footer_logo) {
                unlink('uploads/' . $setting->footer_logo);
            }

            // Get filename with the extension
            $filenameWithExt = $request->file('footer_logo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('footer_logo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = 'setting/' . $filename . '_' . Str::random(5) . '.' . $extension;
            // Upload Image
            Image::make($request->file('footer_logo'))->resize(275, 155)->save('uploads/' . $fileNameToStore);
            Setting::where('id', $request->setting_id)->update(
                [
                    "footer_logo" => $fileNameToStore,
                ]
            );
        }
        if (request()->hasFile('innerpage')) {
            if ($setting->innerpage) {
                unlink('uploads/' . $setting->innerpage);
            }

            // Get filename with the extension
            $filenameWithExt = $request->file('innerpage')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('innerpage')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = 'setting/' . $filename . '_' . Str::random(5) . '.' . $extension;
            // Upload Image
            Image::make($request->file('innerpage'))->resize(1300, 400)->save('uploads/' . $fileNameToStore);
            Setting::where('id', $request->setting_id)->update(
                [
                    "innerpage" => $fileNameToStore,
                ]
            );
        }
        return back()->with('addsuccess', 'add successfully');
    }

}