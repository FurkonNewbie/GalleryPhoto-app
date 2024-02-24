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
        $report = User::findOrFail($id);
        $report->delete();
        return redirect('/hapus_akun')->with('success', 'hapus akun berhasil');
    }
}
