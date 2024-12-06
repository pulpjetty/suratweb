<?php

namespace App\Http\Controllers;

use App\Model\Aktifitas;
use App\Model\Arsip;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AktifitasController extends Controller
{

    public function index()
    {
        //Get all users
//        $arsips = Arsip::orderBy('id', 'desc')->get();
        $aktifitas = Aktifitas::where('judulkegiatan', '=', 'user_id')
            ->orderBy('id', 'desc')
            ->get();
        // Return a collection of $aktifitas with pagination
//        return UserResource::collection($aktifitas);
//        $aktifitas->file;
//        return ArsipResources::collection($aktifitas);

        foreach($aktifitas  as $arsip) {
            $arsip->file = explode('/', $arsip->file)[2];
        }
        return $aktifitas;
    }

     /**
     * Aktifitas api.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judulkegiatan' => 'required',
            'isikegiatan' => ['required', 'min:20', 'max:50'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        } else {
            $input = $request->all();
//            $input['judulkegiatan'] = $input['judulkegiatan'];
//            $input['isikegiatan'] = $input['isikegiatan'];
            $aktifitas = Aktifitas::create($input);
            $success['token'] = $aktifitas->createToken('appToken')->accessToken;
            return response()->json([
                'success' => true,
                'token' => $success,
                'kegiatan'  =>  $aktifitas,
//                'kegiatan'  =>  $aktifitas->all(),
//                'user_id' => $request->user_id,
//                'user_id'   =>  Auth::user()->id,
            ]);
        }
    }
}
