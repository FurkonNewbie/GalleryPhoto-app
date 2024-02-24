<?php

namespace App\Http\Controllers;

use App\Models\foto;
use App\Models\like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{



    public function index()
    {
        $profile = User::where('id', auth()->user()->id)->first();
        $datafoto = foto::with(['user'])->where('user_id', auth()->user()->id)->get();
        // Check if the profile image is not set, then use the new default image
        $defaultProfileImagePath = 'assets/users.png';

        if (is_null($profile->profile)) {
            $profile->profile = $defaultProfileImagePath;
        }

        // Only allow users with the role 'user' to access the profile
        if ($profile->role === 'user') {
            return view('user.index', compact('profile', 'datafoto'));
        } else {
            // Handle unauthorized access, you can redirect or show an error message
            return redirect('/')->with('error', 'Unauthorized access to user profile');
        }
    }

    public function getdata(Request $request)
    {
        $index = foto::with(['like', 'user'])->orderBy('id', 'DESC')->withCount(['like', 'comment'])->paginate();

        return response()->json([
            'data'       => $index,
            'statuscode' => 200,
            'userId'     => auth()->user()->id
        ]);
    }
    // public function getdatadetail(Request $request, $id)
    // {
    //     $dataDetailFoto = foto::with('user')->where('id', $id)->firstOrFail();
    //     $dataFollow = follow::where('follow_id', $dataDetailFoto->user->id)->where('user_id', auth()->user()->id)->first();


    //     return response()->json([
    //         'dataDetailFoto'    => $dataDetailFoto,
    //         'dataUser' => auth()->user()->id,
    //         'dataFollow' => $dataFollow
    //     ], 200);
    // }

    // var idUser;
    // if (res.dataFollow == null) {
    //     idUser = ""
    // } else {
    //     idUser = res.dataFollow.user_id
    // }

    // if (res.dataDetailFoto.user_id === res.dataUser) {
    //     $('#tombolfollow').html('')
    // } else {
    //     if (idUser == res.dataUser) {
    //         $('#tombolfollow').html(' <button class="hover:bg-green-100 rounded-sm px-2" onclick="ikuti(this,' + res.dataDetailFoto.user_id + ')"> mengikuti </button> ')
    //     } else {
    //         $('#tombolfollow').html(' <button class="hover:bg-green-100 rounded-sm px-2" onclick="ikuti(this,' + res.dataDetailFoto.user_id + ')"> + ikuti </button> ')

    //     }
    // }
    public function like(Request $request)
    {
        try {
            $request->validate([
                'fotoid' => 'required'
            ]);
            $existingLike = like::where('foto_id', $request->fotoid)->where('user_id', auth()->user()->id)->first();
            if (!$existingLike) {
                $dataSimpan = [
                    'foto_id' => $request->fotoid,
                    'user_id' => auth()->user()->id
                ];
                like::create($dataSimpan);
            } else {
                like::where('foto_id', $request->fotoid)->where('user_id', auth()->user()->id)->delete();
            }
            return response()->json('Data berhasil di simpan', 200);
        } catch (\Throwable $th) {
            return response()->json('ada kesalahan', 500);
        }
    }
}
