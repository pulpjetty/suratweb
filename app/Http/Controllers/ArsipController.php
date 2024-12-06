<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Arsip;
use App\Model\Aktifitas;
use App\Http\Resources\ArsipResources;

class ArsipController extends Controller
{
    //
    public function index()
    {
        //Get all users
//        $arsips = Arsip::orderBy('id', 'desc')->get();
        $arsips = Arsip::where('jenis_surat', '=', 'Keluar')
            ->orderBy('id', 'desc')
            ->get();
        // Return a collection of $arsips with pagination
//        return UserResource::collection($arsips);
//        $arsips->file;
//        return ArsipResources::collection($arsips);

        foreach($arsips  as $arsip) {
            $arsip->file = explode('/', $arsip->file)[2];
        }
        return $arsips;
    }

    public function indexactivitylist()
    {
        //Get all users
        $arsips = Aktifitas::orderBy('id', 'desc')->get();

        return $arsips;
    }
}
