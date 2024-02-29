<?php

namespace App\Http\Controllers;

use App\Models\foto;
use App\Models\User;
use App\Models\album;
use App\Models\report;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()

    {
        $dataUser = User::orderBy('id', 'DESC')->where('role', 'user')->get();
        $jumlahDataUploadUser = count($dataUser);
        $userCount = User::where('role', 'user')->count();
        $albumKategori = album::all()->count();

        return view('admin.dashboard', compact('dataUser', 'userCount', 'albumKategori', 'jumlahDataUploadUser'));
    }

    public function hapus_report()
    {
        $report = report::with('user', 'foto')->get();
        return view('admin.hapus_report', compact('report'));
    }
    public function profile_admin()
    {
        return view('admin.profile_admin');
    }
    public function hapus_akun()
    {
        $user = User::where('role', 'user')->get();
        return view('admin.hapus_akun', compact('user'));
    }
    //fungsi hapus akun
    public function hapus_account(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Hapus rekaman terkait dari tabel report
        $user->report()->delete();

        // Hapus rekaman terkait dari tabel album dan foto
        foreach ($user->album as $album) {
            foreach ($album->foto as $foto) {
                // Hapus rekaman di tabel report yang terkait dengan foto
                $foto->report()->delete();

                // Hapus rekaman di tabel comment yang terkait dengan foto
                $foto->comment()->delete();

                // Hapus rekaman di tabel like yang terkait dengan foto
                $foto->like()->delete();

                // Hapus rekaman di tabel foto
                $foto->delete();
            }
            $album->delete();
        }

        // Hapus rekaman terkait dari tabel like dan comment
        $user->like()->delete();
        $user->comment()->delete();

        // Hapus rekaman terkait dari tabel foto
        $user->foto()->delete();

        // Hapus pengguna
        $user->delete();

        return redirect('/hapus_akun')->with('success', 'Hapus akun berhasil');
    }
}
