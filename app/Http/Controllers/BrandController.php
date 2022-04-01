<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }

    public function index()
    {
        return view('admin.brand.index', [
            'brands' => Brand::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Brand::create([
            'name' => $request->name,
        ]);

        return redirect(route('brand.index'))->with('addsuccess', 'add successfully');
    }


    public function update(Request $request, Brand $brand)
    {
        $brand->update([
            'name' => $request->name,
        ]);
        return back()->with('editsuccess', 'edit successfully');
    }


    public function destroy(Brand $brand)
    {
        $brand->delete();
        return back()->with('softdeletesuccess', 'softdelete successfully');
    }

    public function brandrestoreview()
    {
        return view('admin.brand.restore', [
            'brands' => Brand::onlyTrashed()->get(),
        ]);
    }

    public function brandrestore($id)
    {
        brand::withTrashed()->find($id)->restore();
        return redirect(route('brand.index'))->with('restoresuccess', 'restore successfully');
    }

    public function forcedelete($id)
    {
        brand::withTrashed()->find($id)->forcedelete();
        return back()->with('forcedeletesuccess', 'forcedelete successfully');
    }
}
