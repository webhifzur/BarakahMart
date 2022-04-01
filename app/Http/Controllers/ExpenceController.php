<?php

namespace App\Http\Controllers;

use App\Models\Expence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }

    public function index()
    {
        return view('admin.expence.index', [
            'expences' => Expence::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'taka' => ['required'],
        ]);

        Expence::create([
            'type' => $request->type,
            'taka' => $request->taka,
            'created_by' => Auth::id(),
        ]);

        return redirect(route('expence.index'))->with('addsuccess', 'add successfully');
    }


    public function update(Request $request, Expence $expence)
    {
        $expence->update([
            'type' => $request->type,
            'taka' => $request->taka,
            'created_by' => Auth::id(),
        ]);
        return back()->with('editsuccess', 'edit successfully');
    }


    public function destroy(Expence $expence)
    {
        $expence->delete();
        return back()->with('softdeletesuccess', 'softdelete successfully');
    }

    public function expencerestoreview()
    {
        return view('admin.expence.restore', [
            'expences' => Expence::onlyTrashed()->get(),
        ]);
    }

    public function expencerestore($id)
    {
        Expence::withTrashed()->find($id)->restore();
        return redirect(route('expence.index'))->with('restoresuccess', 'restore successfully');
    }

    public function forcedelete($id)
    {
        Expence::withTrashed()->find($id)->forcedelete();
        return back()->with('forcedeletesuccess', 'forcedelete successfully');
    }
}
