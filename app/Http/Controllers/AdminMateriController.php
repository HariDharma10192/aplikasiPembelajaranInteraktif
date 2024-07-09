<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminMateriController extends Controller
{
    public function create()
    {
        return view('admin.materi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
                Rule::unique('materi', 'judul'),
            ],
            'materi1' => 'required_without:materi2|file|mimes:pdf|max:5120',
            'materi2' => 'required_without:materi1|file|mimes:pdf|max:5120',
        ], [
            'judul.unique' => 'Judul materi sudah ada. Silakan gunakan judul lain.',
            'materi1.required_without' => 'Anda harus mengunggah setidaknya satu materi.',
            'materi2.required_without' => 'Anda harus mengunggah setidaknya satu materi.',
            'materi1.max' => 'Ukuran file Materi 1 tidak boleh lebih dari 5MB.',
            'materi2.max' => 'Ukuran file Materi 2 tidak boleh lebih dari 5MB.',
        ]);

        $materi1Path = null;
        $materi2Path = null;

        if ($request->hasFile('materi1')) {
            $materi1 = $request->file('materi1');
            $materi1Name = Str::uuid() . '_' . $materi1->getClientOriginalName();
            $materi1Path = $materi1->storeAs('materi', $materi1Name, 'public');
        }

        if ($request->hasFile('materi2')) {
            $materi2 = $request->file('materi2');
            $materi2Name = Str::uuid() . '_' . $materi2->getClientOriginalName();
            $materi2Path = $materi2->storeAs('materi', $materi2Name, 'public');
        }

        Materi::create([
            'judul' => $request->judul,
            'materi1' => $materi1Path,
            'materi2' => $materi2Path,
        ]);

        return back()->with('success', 'Materi berhasil diunggah.');
    }
    public function show(Request $request)
    {
        $query = Materi::withCount('quis');

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $materis = $query->orderBy('created_at', 'desc')->paginate(10); // 10 adalah jumlah item per halaman

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
