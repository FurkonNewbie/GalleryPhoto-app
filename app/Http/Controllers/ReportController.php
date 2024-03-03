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

    //user membuat report
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
            'user_id' => auth()->user()->id,
            'foto_id' => $foto->id,
            'deskripsi' => $validatedData['deskripsi'],
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil disimpan.');
    }

    //menga,bil halaman report dan berdasarkan id foto user
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
    // public function destroy($id)
    // {
    //     try {
    //         $report = report::find($id);

    //         // Periksa apakah data laporan ditemukan
    //         if (!$report) {
    //             return redirect('/hapus_akun')->with('error', 'Data laporan tidak ditemukan.');
    //         }

    //         // Hapus data laporan terlebih dahulu
    //         $report->delete();

    //         // Hapus data komen terkait
    //         comment::where('foto_id', $report->foto_id)->delete();

    //         // Hapus data like terkait
    //         like::where('foto_id', $report->foto_id)->delete();

    //         // Hapus data foto terlebih dahulu (jika ada)
    //         if ($report->foto) {
    //             Storage::delete('/foto/' . $report->foto->url);
    //             foto::destroy($report->foto->id);
    //         }

    //         return redirect('/hapus_akun')->with('success', 'Report berhasil dihapus beserta relasinya.');
    //     } catch (\Exception $e) {
    //         return redirect('/hapus_akun')->with('error', 'Gagal menghapus report dan relasinya: ' . $e->getMessage());
    //     }
    // }

    //fungsi untuk menghapus report oleh admin
    public function destroy($id)
    {
        try {
            // Temukan data laporan
            $report = report::find($id);

            // Periksa apakah data laporan ditemukan
            if (!$report) {
                return redirect('/hapus_akun')->with('error', 'Data laporan tidak ditemukan.');
            }

            // Hapus data komen terkait
            comment::where('foto_id', $report->foto_id)->delete();

            // Hapus data like terkait
            like::where('foto_id', $report->foto_id)->delete();

            // Hapus data laporan
            $report->delete();

            // Hapus data foto terlebih dahulu (jika ada)
            if ($report->foto) {
                // Hapus referensi dari tabel foto
                $report->foto->report_id = null;
                $report->foto->save();

                // Hapus data foto
                foto::destroy($report->foto->id);
            }

            return redirect('/hapus_report')->with('success', 'Report berhasil dihapus beserta relasinya.');
        } catch (\Exception $e) {
            return redirect('/hapus_report')->with('error', 'Gagal menghapus report dan relasinya: ' . $e->getMessage());
        }
    }
}
