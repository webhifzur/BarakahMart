<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('profile',[
            'user' => User::where('id', Auth::user()->id)->first()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255',],
            'phone' => ['required',],
            'city' => ['required'],
            'area' => ['required'],
            'address' => ['required'],
        ]);

        if (request()->hasFile('profile_img')) {

            $user = User::where('id', Auth::user()->id)->first();
            if ($user->profile_img) {
                unlink('storage/public/' . $user->profile_img);
            }

            // Get filename with the extension
            $filenameWithExt = $request->file('profile_img')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile_img')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = 'profile-photos/' . $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('profile_img')->storeAs('public', $fileNameToStore);

            User::where("id", Auth::user()->id)->update(
                [
                    "profile_img" => $fileNameToStore,
                ]
            );
        }

        User::where("id", Auth::user()->id)->update(
            [
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "city" => $request->city,
                "area" => $request->area,
                "address" => $request->address,
            ]
        );

        $user = User::where('id', Auth::user()->id)->first();
        return redirect()->route('dashboard.profile')->with(['user' => $user])->with('updateprofile', 'updateprofile success');
    }

    public function updatepassword(Request $request)
    {
        $request->validate([
            'oldpassword' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        if (Hash::check($request->oldpassword, Auth::user()->password)) {
            User::where('id', Auth::user()->id)->update(
                [
                    'password' => Hash::make($request->password),
                ]
            );

            $user = User::where('id', Auth::user()->id)->first();
            return redirect()->route('dashboard.profile')->with(['user' => $user])->with('passwordsuccess', 'password success');
        }

        $user = User::where('id', Auth::user()->id)->first();
        return redirect()->route('dashboard.profile')->with(['user' => $user])->with('oldpassword', 'Old Password does not match..');
    }
}
