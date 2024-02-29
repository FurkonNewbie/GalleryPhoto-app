<?php

namespace App\Http\Controllers;


use App\Models\foto;
use App\Models\like;
use App\Models\album;
use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{
    public function upload()
    {
        $albums = album::all();
        return view('user.upload', compact('albums'));
    }

    public function save(Request $request)
    {
        // Validasi tipe mime file
        $request->validate([
            'fileFoto' => 'image|mimes:jpeg,png|max:2048',
        ]);

        // Logika penyimpanan foto sesuai kebutuhan Anda
        $filename = pathinfo($request->fileFoto, PATHINFO_FILENAME);

        $extension = $request->fileFoto->getClientOriginalExtension();
        $namafoto = 'foto' . time() . '.' . $extension;
        $request->fileFoto->move('foto', $namafoto);

        $datasimpan = [
            'user_id' => auth()->user()->id,
            'album_id' => $request->nama_album,
            'judul_foto' => $request->judul_foto,
            'deskripsi' => $request->deskripsi,
            'url' => $namafoto
        ];

        foto::create($datasimpan);
        return redirect('/index')->with('success', 'Berhasil upload foto.');
    }


    public function album(Request $request)
    {
        if ($request->album_id == 0) {
            // Jika album_id adalah 0, itu berarti memilih opsi "Tambah Album Baru"
            $dataalbum = [
                'user_id' => auth()->user()->id,
                'nama_album' => $request->nama_album,

            ];
            album::create($dataalbum);
        }

        // Ambil ulang data album
        $albums = album::all();

        return redirect('/upload')->with('success', 'Berhasil menambahkan album.');
    }
    public function uploaded()
    {
        $datafoto = foto::with(['user', 'album'])->where('user_id', auth()->user()->id)->get();
        return view('user.uploaded', compact('datafoto'));
    }
    public function destroyFoto(Request $request, foto $foto)
    {

        if ($foto->user_id != auth()->user()->id) {
            return back()->with('error', 'Tidak diizinkan menghapus foto ini.');
        }



        // Lakukan penghapusan
        try {
            // Mulai transaksi database
            DB::beginTransaction();

            // Hapus data like terkait
            like::where('foto_id', $foto->id)->delete();

            // Hapus data komen
            comment::where('foto_id', $foto->id)->delete();

            // Hapus data foto dari database
            $foto->delete();

            // Commit transaksi jika semua operasi di atas berhasil
            DB::commit();

            return back()->with('success', 'Foto berhasil dihapus.');
        } catch (\Exception $e) {
            // Jika terjadi exception, rollback transaksi
            DB::rollback();
            return back()->with('error', 'Error saat menghapus foto: ' . $e->getMessage());
        }
    }

    public function edit_upload($id)
    {
        $albums = album::all();
        $foto = foto::where('id', $id)->first(); // Replace 1 with the actual ID or logic to find the appropriate foto
        return view('user.edit_upload', compact('foto', 'albums'));
    }
    public function updateFoto(Request $request, foto $foto)
    {
        // Validation logic if needed

        // Update the photo
        $foto->update([
            'judul_foto' => $request->judul_foto,
            'deskripsi' => $request->deskripsi,
            'album_id' => $request->album_id,
            // Update other fields as needed
        ]);

        return redirect('/index')->with('success', 'Photo updated successfully.');
    }
}
