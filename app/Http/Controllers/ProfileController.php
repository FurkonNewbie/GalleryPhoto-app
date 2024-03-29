<?php

namespace App\Http\Controllers;

use App\Models\foto;
use App\Models\User;
use App\Models\album;
use App\Models\follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    //fungsi untuk menampilkan halaman profile user
    public function profil()
    {

        $tampilUpload = foto::with('album')->where('user_id', auth()->user()->id)->get();
        $tampilAlbum = album::with('foto')->where('user_id', auth()->user()->id)->get();
        $profile = User::where('id', auth()->user()->id)->first();
        $user = auth()->user();

        $userFollowers = DB::table('follow')->where('follow_id', $user->id)->count();
        $dataFollowCount = DB::table('follow')->where('user_id', $user->id)->count();
        // Check if the profile image is not set, then use the new default image
        $defaultProfileImagePath = 'assets/users.png';

        if (is_null($profile->profile)) {
            $profile->profile = $defaultProfileImagePath;
        }
        // $dataJumlahFollow = DB::table('follow')->selectRaw('count(follow_id) as jmlfollow')->where('follow_id', $profile->user->id)->first();
        return view('user.profile', compact('profile', 'tampilUpload', 'tampilAlbum', 'userFollowers', 'dataFollowCount'));
    }

    //fungsi untuk menampilkan halaman profile user lain
    // public function profil_other(Request $request, $id)
    // {
    //     $profile = foto::with('user')->where('user_id', $id)->whereHas('user', function ($query) {
    //         $query->where('role', 'user');
    //     })->first();

    //     // Check if the profile exists and the role is 'user'
    //     if ($profile) {
    //         return view('user.profile_other', compact('profile'));
    //     } else {
    //         // Handle the case where the profile doesn't exist or the role is not 'user'
    //         return abort(404); // You can customize this to your needs
    //     }
    // }
    public function profil_other(Request $request, $id)
    {
        // Mengaktifkan log query
        DB::enableQueryLog();

        // Mengambil profil dengan relasi user
        $profile = Foto::with('user')->where('user_id', $id)->first();

        // Menampilkan log query untuk debugging
        // dd(DB::getQueryLog());

        // Menampilkan halaman profil_other dengan data foto dan user
        if ($profile && $profile->user && $profile->user->role == 'user') {
            return view('user.profile_other', compact('profile'));
        } else {
            // Handle the case where the profile doesn't exist or the role is not 'user'
            return abort(404);
        }
    }



    //fungsi untuk menampilkan gambar di dalam album
    public function show($id)
    {
        $album = album::with('foto')->findOrFail($id);
        return view('user.album', compact('album'));
    }

    //fungsi untuk menampilkan halaman edit profile user
    public function edit_profile()
    {
        $profile = User::where('id', auth()->user()->id)->first();
        return view('user.edit_profile', compact('profile'));
    }

    //fungsi untuk mengubah data profile user
    public function up_profile(Request $request)
    {
        // Validation rules
        $rules = [
            'username' => 'required|string|max:255',
            'no_telepon' => 'numeric|digits:12',
            // Added min:12 validation
            'email' => 'required|string|email|max:255',
            'bio' => 'nullable|string',
            'alamat' => 'nullable|string|max:255',
            'profile' => 'image|mimes:jpeg,png,jpg,gif,bmp,webp|max:2048', // Assuming it's an image file
        ];

        // Validate the request data
        $request->validate($rules);

        // Inisialisasi array dataToUpdate
        $dataToUpdate = [];

        // Check if a file is present in the request
        if ($request->hasFile('profile')) {
            // Logika penyimpanan foto sesuai kebutuhan Anda
            $filename = pathinfo($request->profile, PATHINFO_FILENAME);

            $extension = $request->profile->getClientOriginalExtension();
            $namafoto = 'profile' . time() . '.' . $extension;
            $request->profile->move('profile', $namafoto);

            // Update the 'profile' field only if a file is uploaded
            $dataToUpdate['profile'] = $namafoto;
        }

        // Update data lainnya
        $dataToUpdate += [
            'username' => $request->username,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'bio' => $request->bio,
            'alamat' => $request->alamat,
        ];

        //proses update
        User::where('id', auth()->user()->id)->update($dataToUpdate);

        return redirect('/profil')->with('success', 'Profil berhasil diperbarui');
    }



    //fungsi untuk mengubah password user
    public function up_password(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $request->validate([
            'current_password' => 'required|password',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $dataToUpdate = [
            'password' => bcrypt($request->input('new_password')),
        ];

        $user->update($dataToUpdate);

        return redirect('profil')->with('success', 'Password Berhasil Diubah!');
    }


    //fungsi untuk menampilkan jumlah followers dan following
    public function getDataProfil(Request $request, $id)
    {
        $dataUser = User::where('id', $id)->first();

        // Use parameter binding to avoid SQL injection
        $dataJumlahFollower = DB::select('SELECT COUNT(user_id) as jmlfollower FROM follow WHERE follow_id = ?', [$id]);
        $dataJumlahFollowing = DB::select('SELECT COUNT(follow_id) as jmlfollowing FROM follow WHERE user_id = ?', [$id]);

        $dataFollow = follow::where('follow_id', $id)->where('user_id', auth()->user()->id)->first();

        //datafollow
        $dataFollowers = DB::select('SELECT COUNT(follow_id) as jmlfollowers FROM follow WHERE follow_id = ?', [$id]);
        $dataFollowing = DB::select('SELECT COUNT(follow_id) as jmlfollowers FROM follow WHERE user_id = ?', [$id]);

        return response()->json([
            'dataUser' => $dataUser,

            'jumlahFollower' => $dataJumlahFollower,
            'jumlahFollowing' => $dataJumlahFollowing,

            'datafollowers' => $dataFollowers,
            'datafollowing' => $dataFollowing,

            'dataUserActive' => auth()->user()->id,
            'dataFollow' => $dataFollow
        ], 200);
    }

    //enampilkan jumlah postingan user lain
    public function getdataprofilother(Request $request)
    {
        // $dataUser               = User::where('id', $id)->firstOrFail();

        $index                  = foto::with(['user'])->where('user_id', $request->userId)->paginate();
        $role                   = User::where('role', 'user');
        return response()->json([
            // 'datauser'                 => $dataUser,

            'data'                     => $index,
            'statuscode'               => 200,
            'userId'                   => auth()->user()->id
        ]);
    }

    //menampilkan jumlah followers dan following untuk user sedang login
    public function getProfil(Request $request, $id)
    {
        // Jika $id sama dengan ID pengguna yang sedang masuk (profil sendiri)
        if ($id == auth()->user()->id) {
            $dataUser = User::find($id); // Menggunakan find untuk mencari pengguna berdasarkan ID
            $dataJumlahFollower = follow::where('user_id', $id)->count(); // Menghitung jumlah follower
            $dataJumlahFollowing = follow::where('follow_id', $id)->count(); // Menghitung jumlah following
            $dataFollow = null; // Tidak perlu mencari data follow untuk profil sendiri
        } else {
            // Jika $id bukan sama dengan ID pengguna yang sedang masuk (profil pengguna lain)
            $dataUser = User::where('id', $id)->first();
            $dataJumlahFollower = DB::select('SELECT COUNT(user_id) as jmlfollower FROM follow WHERE follow_id = ?', [$id]);
            $dataJumlahFollowing = DB::select('SELECT COUNT(follow_id) as jmlfollowing FROM follow WHERE user_id = ?', [$id]);
            $dataFollow = follow::where('follow_id', $id)->where('user_id', auth()->user()->id)->first();
        }

        $dataFollowers = DB::select('SELECT COUNT(follow_id) as jmlfollowers FROM follow WHERE follow_id = ?', [$id]);
        $dataFollowing = DB::select('SELECT COUNT(follow_id) as jmlfollowing FROM follow WHERE user_id = ?', [$id]);

        return response()->json([
            'dataUser' => $dataUser,
            'jumlahFollower' => $dataJumlahFollower,
            'jumlahFollowing' => $dataJumlahFollowing,
            'datafollowers' => $dataFollowers,
            'datafollowing' => $dataFollowing,
            'dataUserActive' => auth()->user()->id,
            'dataFollow' => $dataFollow
        ], 200);
    }
}
