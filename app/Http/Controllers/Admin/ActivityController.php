<?php

namespace App\Http\Controllers\Admin;

use App\Model\Aktifitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
////        $activitys = Aktifitas ::orderBy('id', '=', 'DESC')->get();
        $activities = Aktifitas::where('user_id', '=', Auth::user()->id)->get();
////        $activitys = DB::select('select * from activitys where user_id = ?', [3]);
//
        return view('admin.addactivity', compact('activities'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judulkegiatan' => 'required',
            'isikegiatan' => ['required', 'min:20', 'max:50'],
        ]);
        $attributes = ([
            'judulkegiatan' => $request->judulkegiatan,
            'isikegiatan' => $request->isikegiatan,
            'user_id' => Auth::user()->id,
        ]);

        Aktifitas::create($attributes);

        return redirect()->back()->with('success', 'Saving data successfully !');
    }
}
