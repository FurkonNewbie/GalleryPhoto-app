<?php

namespace App\Http\Controllers;

use App\Models\foto;
use App\Models\User;
use App\Models\follow;
use App\Models\comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment($id)
    {

        return view('user.comment');
    }

    public function getdatadetail(Request $request, $id)
    {
        $dataDetailFoto = foto::with('user')->where('id', $id)->firstOrFail();
        $dataFollow = follow::where('follow_id', $dataDetailFoto->user->id)->where('user_id', auth()->user()->id)->first();


        return response()->json([
            'dataDetailFoto'    => $dataDetailFoto,
            'dataUser' => auth()->user()->id,
            'dataFollow' => $dataFollow
        ], 200);
    }

    public function ambildatakomentar(Request $request, $id)
    {
        $ambilkomentar = comment::with('user')->where('foto_id', $id)->get();
        return response()->json([
            'data'  => $ambilkomentar
        ], 200);
    }

    public function kirimkomentar(Request $request)
    {
        try {
            $request->validate([
                'idfoto'            => 'required',
                'isi_komentar'      => 'required',
            ]);

            $dataStoreKomentar = [
                'user_id'   => auth()->user()->id,
                'foto_id'   => $request->idfoto,
                'isi_komentar' => $request->isi_komentar
            ];
            comment::create($dataStoreKomentar);
            return response()->json([
                'data'      => 'Data berhasil disimpan'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json('data komentar gagal disimpan', 500);
        }
    }

    public function ikuti(Request $request)
    {
        try {
            $request->validate([
                'idfollow'      => 'required'
            ]);
            $existingFollow = follow::where('user_id', auth()->user()->id)->where('follow_id', $request->idfollow)->first();

            if (!$existingFollow) {
                $dataSimpan = [
                    'user_id' => auth()->user()->id,
                    'follow_id' => $request->idfollow
                ];
                follow::create($dataSimpan);
            } else {
                follow::where('user_id', auth()->user()->id)->where('follow_id', $request->idfollow)->delete();
            }
            return response()->json('data berhasil di eksekusi', 200);
        } catch (\Throwable $th) {
            return response()->json('something went wrong', 500);
        }
    }
}

//siwniws
