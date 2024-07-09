<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class UserMateriController extends Controller
{
    // Menampilkan daftar judul materi dengan pencarian dan paginasi
    public function index(Request $request)
    {
        $query = Materi::query();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $materis = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('users.materi.index', compact('materis'));
    }

    // Menampilkan materi 1 berdasarkan id materi
    public function showMateri1($id)
    {
        $materi = Materi::findOrFail($id);
        return response()->json($materi);
    }
    // Menampilkan materi 2 berdasarkan id materi
    public function showMateri2($id)
    {
        $materi = Materi::findOrFail($id);
        return response()->json($materi);
    }

    // Menampilkan daftar judul materi 2 dengan pencarian dan paginasi
    public function materi2Index(Request $request)
    {
        $query = Materi::query();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $materis = $query->whereNotNull('materi2')->orderBy('created_at', 'desc')->paginate(5);

        return view('users.materi.materi2', compact('materis'));
    }
}
