<?php

namespace App\Http\Controllers;

use App\Models\foto;

use App\Models\like;
use App\Models\report;
use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{

    public function report(Request $request, $id)
    {
        // Find the photo by ID
        $foto = Foto::find($id);

        // Ensure the photo exists
        if (!$foto) {
            // Handle if the photo with the given ID is not found
            abort(404);
        }

        // Validate the form data
        $validatedData = $request->validate([
            'deskripsi' => 'required',
        ]);

        // Create the report
        $report = Report::create([
            'user_id' => auth()->user()->id,      // Get the authenticated user's ID
            'foto_id' => $foto->id,       // Use the ID of the photo being reported
            'deskripsi' => $validatedData['deskripsi'],
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil disimpan.');
    }

    public function report_foto($id)
    {
        $foto = foto::find($id);

        if (!$foto) {
            // Handle if the photo with the given ID is not found
            abort(404);
        }

        return view('user.report', compact('foto'));
    }
    //hapus id report
    public function destroy($id)
    {

        $report = report::findOrFail($id);
        // Periksa apakah data laporan ditemukan
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        // Hapus data foto dari penyimpanan (jika diperlukan)
        Storage::delete('/foto/' . $report->foto->lokasi_file);

        $report->delete();


        // Hapus data like terkait
        like::where('foto_id', $id)->delete();

        // Hapus data komen terkait
        comment::where('foto_id', $id)->delete();

        // Hapus data foto dari database
        foto::destroy($id);
        return redirect('/hapus_akun')->with('success', 'Report berhasil dihapus.');
    }
}
