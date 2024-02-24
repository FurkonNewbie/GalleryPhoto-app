<?php

namespace App\Http\Controllers;


use App\Models\album;
use App\Models\foto;
use Illuminate\Http\Request;

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
            // ... (Tambahkan validasi lainnya jika diperlukan)
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

        // Logika lainnya sesuai kebutuhan Anda

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
        // Ensure the user can only delete their own photos
        if ($foto->user_id != auth()->user()->id) {
            return back()->with('error', 'Unauthorized to delete this photo.');
        }

        // Optionally, you might want to perform additional checks before deleting.

        // Perform the deletion
        $foto->delete();

        return back()->with('success', 'Photo deleted successfully.');
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
