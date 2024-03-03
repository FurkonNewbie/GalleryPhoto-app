<?php

namespace App\Http\Controllers;

use App\Models\foto;
use App\Models\like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    //menampilkan halaman index
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

    //menampilkan data looping di halaman index
    public function getdata(Request $request)
    {
        $index = foto::with(['like', 'user'])->orderBy('id', 'DESC')->withCount(['like', 'comment'])->paginate();

        return response()->json([
            'data'       => $index,
            'statuscode' => 200,
            'userId'     => auth()->user()->id
        ]);
    }
    
    //fungsi tombol like
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
