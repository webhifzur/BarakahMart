<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }

    public function index()
    {
        return view('admin.area.index', [
            'areas' => Area::all(),
            'cities' => City::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city_id' => ['required'],
        ]);

        Area::create([
            'name' => $request->name,
            'city_id' => $request->city_id,
        ]);

        return redirect(route('area.index'))->with('addsuccess', 'add successfully');
    }


    public function update(Request $request, Area $area)
    {
        $area->update([
            'name' => $request->name,
            'city_id' => $request->city_id,
        ]);
        return back()->with('editsuccess', 'edit successfully');
    }


    public function destroy(Area $area)
    {
        $area->delete();
        return back()->with('softdeletesuccess', 'softdelete successfully');
    }

    public function arearestoreview()
    {
        return view('admin.area.restore', [
            'areas' => Area::onlyTrashed()->get(),
        ]);
    }

    public function arearestore($id)
    {
        Area::withTrashed()->find($id)->restore();
        return redirect(route('area.index'))->with('restoresuccess', 'restore successfully');
    }

    public function forcedelete($id)
    {
        Area::withTrashed()->find($id)->forcedelete();
        return back()->with('forcedeletesuccess', 'forcedelete successfully');
    }
}
