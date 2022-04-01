<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('customer');
    }

    public function index()
    {
        return view('vendor.index', [
            'vendors' => Vendor::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:vendors'],
            'phone' => ['required'],
        ]);

        Vendor::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect(route('vendor.index'))->with('addsuccess', 'add successfully');
    }


    public function update(Request $request, Vendor $vendor)
    {
        $vendor->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return back()->with('editsuccess', 'edit successfully');
    }


    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return back()->with('softdeletesuccess', 'softdelete successfully');
    }

    public function vendorrestoreview()
    {
        return view('vendor.restore', [
            'vendors' =>Vendor::onlyTrashed()->get(),
        ]);
    }

    public function vendorrestore($id)
    {
        Vendor::withTrashed()->find($id)->restore();
        return redirect(route('vendor.index'))->with('restoresuccess', 'restore successfully');
    }

    public function forcedelete($id)
    {
        Vendor::withTrashed()->find($id)->forcedelete();
        return back()->with('forcedeletesuccess', 'forcedelete successfully');
    }
}
