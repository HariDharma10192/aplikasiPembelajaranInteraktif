<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminMateriController extends Controller
{
    public function create()
    {
        return view('admin.materi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'materi1' => 'required|file|mimes:pdf|max:2048',
            'materi2' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Handle file upload for materi1
        $materi1 = $request->file('materi1');
        $materi1Name = Str::uuid() . '_' . $materi1->getClientOriginalName();
        $materi1Path = $materi1->storeAs('materi', $materi1Name, 'public');

        // Handle file upload for materi2
        $materi2 = $request->file('materi2');
        $materi2Name = Str::uuid() . '_' . $materi2->getClientOriginalName();
        $materi2Path = $materi2->storeAs('materi', $materi2Name, 'public');

        // Create new Materi
        Materi::create([
            'judul' => $request->judul,
            'materi1' => $materi1Path,
            'materi2' => $materi2Path,
        ]);

        return back()->with('success', 'Materi berhasil diunggah.');
    }
    public function show()
    {
        $materis = Materi::withCount('quis')->get();
        return view('admin.materi.index', compact('materis'));
    }

    public function destroy($id)
    {
        $materi = Materi::find($id);

        if ($materi->quis()->count() == 0) {
            // Hapus file dari storage
            Storage::disk('public')->delete($materi->materi1);
            Storage::disk('public')->delete($materi->materi2);

            // Hapus data dari database
            $materi->delete();

            return back()->with('success', 'Materi berhasil dihapus.');
        }

        return back()->with('error', 'Materi tidak dapat dihapus karena terikat dengan tabel kuis.');
    }
}
