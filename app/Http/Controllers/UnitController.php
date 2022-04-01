<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }

    public function index()
    {
        return view('admin.unit.index', [
            'units' => Unit::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Unit::create([
            'name' => $request->name,
        ]);

        return redirect(route('unit.index'))->with('addsuccess', 'add successfully');
    }


    public function update(Request $request, Unit $unit)
    {
        $unit->update([
            'name' => $request->name,
        ]);
        return back()->with('editsuccess', 'edit successfully');
    }


    public function destroy(Unit $unit)
    {
        $unit->delete();
        return back()->with('softdeletesuccess', 'softdelete successfully');
    }

    public function unitrestoreview()
    {
        return view('admin.unit.restore', [
            'units' => Unit::onlyTrashed()->get(),
        ]);
    }

    public function unitrestore($id)
    {
        Unit::withTrashed()->find($id)->restore();
        return redirect(route('unit.index'))->with('restoresuccess', 'restore successfully');
    }

    public function forcedelete($id)
    {
        Unit::withTrashed()->find($id)->forcedelete();
        return back()->with('forcedeletesuccess', 'forcedelete successfully');
    }
}
