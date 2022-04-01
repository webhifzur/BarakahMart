<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;

class AdminController extends Controller
{
    use PasswordValidationRules;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }

    public function adminlist()
    {
        return view('admin.addminlist.adminlist', [
            'admin_infos' => User::where('type', '!=', 0)->where('type', '!=', 1)->get(),
        ]);
    }

    public function adminregister(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'unique:users'],
            'email' => ['string','email','max:255', 'unique:users'],
            'city' => ['required'],
            'area' => ['required'],
            'address' => ['required'],
            'password' => $this->passwordRules(),
        ]);

        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'city' => $request->city,
            'area' => $request->area,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);

        return back()->with('registersuccess' , 'add successfully');
    }

    public function admindelete($id){
        User::find($id)->delete();
        return back()->with('softdeletesuccess', 'softdelete successfully');
    }

    public function adminrestoreview(){
        return view('admin.addminlist.deletedadminlist',[
            'admin_infos' => User::onlyTrashed()->where('type', '!=', 0)->get(),
        ]);
    }

    public function adminrestore($id){
        User::withTrashed()->find($id)->restore();
        return redirect(route('admin.list'))->with('restoresuccess', 'restore successfully');
    }

    public function forcedelete($id){
        User::withTrashed()->find($id)->forcedelete();
        return redirect(route('admin.list'))->with('forcedeletesuccess', 'forcedelete successfully');
    }
}
