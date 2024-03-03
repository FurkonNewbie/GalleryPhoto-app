<?php

namespace App\Http\Controllers;

use App\Models\foto;
use App\Models\User;
use App\Models\album;
use App\Models\report;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //menampilkan halaman dashboard admin
    public function dashboard()

    {
        $dataUser = User::orderBy('id', 'DESC')->where('role', 'user')->get();
        $jumlahDataUploadUser = count($dataUser);
        $userCount = User::where('role', 'user')->count();
        $albumKategori = album::all()->count();
        $jumlahReport = report::all()->count();

        return view('admin.dashboard', compact('dataUser', 'userCount', 'albumKategori', 'jumlahDataUploadUser', 'jumlahReport'));
    }

    //menampilkan halaman report
    public function hapus_report()
    {
        $report = report::with('user', 'foto')->get();
        return view('admin.hapus_report', compact('report'));
    }
    //menampilkan halaman profile admin
    public function profile_admin()
    {
        return view('admin.profile_admin');
    }
    //menampilkan halaman hapus akun user
    public function hapus_akun()
    {
        $user = User::where('role', 'user')->get();
        $firstUser = $user->first();

        return view('admin.hapus_akun', compact('user', 'firstUser'));
    }

    //fungsi hapus akun
    // public function hapus_account(Request $request, $id)
    // {
    //     try {
    //         // Temukan pengguna
    //         $user = User::findOrFail($id);

    //         // Hapus rekaman terkait di tabel follow
    //         $user->follow()->delete();

    //         // Hapus rekaman terkait di tabel report
    //         $user->report()->delete();

    //         // Hapus rekaman terkait di tabel album dan foto
    //         foreach ($user->album as $album) {
    //             foreach ($album->foto as $foto) {
    //                 // Hapus rekaman terkait di tabel report, comment, dan like
    //                 $foto->report()->delete();
    //                 $foto->comment()->delete();
    //                 $foto->like()->delete();

    //                 // Hapus rekaman di tabel foto
    //                 $foto->delete();
    //             }

    //             // Hapus rekaman di tabel album
    //             $album->delete();
    //         }

    //         // Hapus rekaman terkait di tabel like dan comment
    //         $user->like()->delete();
    //         $user->comment()->delete();

    //         // Hapus rekaman terkait di tabel foto (jika ada yang tersisa)
    //         $user->foto()->each(function ($foto) {
    //             $foto->report()->delete();
    //             $foto->delete();
    //         });

    //         // Hapus rekaman pengguna
    //         $user->delete();

    //         return redirect('/hapus_akun')->with('success', 'Hapus akun berhasil');
    //     } catch (\Exception $e) {
    //         return redirect('/hapus_akun')->with('error', 'Gagal menghapus akun');
    //     }
    // }
    public function hapus_account(Request $request, $id)
    {
        try {
            // Temukan pengguna
            $user = User::findOrFail($id);

            // Hapus rekaman terkait di tabel follow (both following and followers)
            $user->following()->delete();
            $user->followers()->delete();

            // Hapus rekaman terkait di tabel report
            $user->report()->delete();

            // Hapus rekaman terkait di tabel album dan foto
            foreach ($user->album as $album) {
                foreach ($album->foto as $photo) {
                    // Hapus rekaman terkait di tabel report, comment, dan like
                    $photo->report()->delete();
                    $photo->comment()->delete();
                    $photo->like()->delete();

                    // Hapus rekaman di tabel foto
                    $photo->delete();
                }

                // Hapus rekaman di tabel album
                $album->delete();
            }

            // Hapus rekaman terkait di tabel like dan comment
            $user->like()->delete();
            $user->comment()->delete();

            // Hapus rekaman terkait di tabel foto (jika ada yang tersisa)
            $user->foto()->each(function ($photo) {
                $photo->report()->delete();
                $photo->delete();
            });

            // Hapus rekaman pengguna
            $user->delete();

            return redirect('/hapus_akun')->with('success', 'Hapus akun berhasil');
        } catch (\Exception $e) {
            return redirect('/hapus_akun')->with('error', 'Gagal menghapus akun');
        }
    }

    //fungsi update user
    public function update(Request $request, $id)
    {
        // Lakukan validasi atau operasi penyimpanan data di sini
        // Contoh:
        $user = User::find($id);
        $user->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'no_telepon' => $request->input('no_telepon'),
            'alamat' => $request->input('alamat'),
            'bio' => $request->input('bio'),
        ]);

        return redirect()->route('hapus_akun')->with('success', 'User berhasil diupdate');
    }
}
