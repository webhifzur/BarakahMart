<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }

    public function index()
    {
        return view('admin.city.index',[
            'cities' => City::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        City::create([
            'name' => $request->name,
        ]);

        return redirect(route('city.index'))->with('addsuccess', 'add successfully');
    }

    
    public function update(Request $request, City $city)
    {
        $city->update([
            'name' => $request->name,
        ]);
        return back()->with('editsuccess', 'edit successfully');
    }

    
    public function destroy(City $city)
    {
        $city->delete();
        return back()->with('softdeletesuccess', 'softdelete successfully');
    }

    public function cityrestoreview()
    {
        return view('admin.city.restore', [
            'cities' => City::onlyTrashed()->get(),
        ]);
    }

    public function cityrestore($id)
    {
        City::withTrashed()->find($id)->restore();
        return redirect(route('city.index'))->with('restoresuccess', 'restore successfully');
    }

    public function forcedelete($id)
    {
        City::withTrashed()->find($id)->forcedelete();
        return back()->with('forcedeletesuccess', 'forcedelete successfully');
    }

}
