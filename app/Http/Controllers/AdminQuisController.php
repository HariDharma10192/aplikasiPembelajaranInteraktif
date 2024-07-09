<?php

namespace App\Http\Controllers;

use App\Models\Quis;
use App\Models\Materi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserJawabQuis;


class AdminQuisController extends Controller
{
    public function index()
    {
        $materis = Materi::with('quis')->get(); // Mengambil semua materi dengan kuisnya
        return view('admin.quis.index', compact('materis'));
    }

    public function create()
    {
        $materis = Materi::all(); // Mengambil semua materi untuk ditampilkan dalam dropdown
        return view('admin.quis.create', compact('materis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'materi_id' => 'required|exists:materi,id',
            'questions.*.question' => 'required|string|max:255',
            'questions.*.option_a' => 'required|string|max:255',
            'questions.*.option_b' => 'required|string|max:255',
            'questions.*.option_c' => 'required|string|max:255',
            'questions.*.option_d' => 'required|string|max:255',
            'questions.*.correct_answer' => 'required|string|in:A,B,C,D',
        ]);

        foreach ($request->questions as $question) {
            Quis::create([
                'materi_id' => $request->materi_id,
                'question' => $question['question'],
                'option_a' => $question['option_a'],
                'option_b' => $question['option_b'],
                'option_c' => $question['option_c'],
                'option_d' => $question['option_d'],
                'correct_answer' => $question['correct_answer'],
            ]);
        }

        return back()->with('success', 'Kuis berhasil ditambahkan.');
    }
    public function evaluasi(Request $request)
    {
        $search = $request->input('search');
        $materis = Materi::when($search, function ($query, $search) {
            return $query->where('judul', 'like', "%{$search}%");
        })->get();

        return view('admin.quis.evaluasi', compact('materis', 'search'));
    }

    public function showEvaluasi($materi_id)
    {
        $materi = Materi::with('userJawabQuis.user')->find($materi_id);
        if (!$materi) {
            return redirect()->route('admin.quis.evaluasi')->with('error', 'Materi tidak ditemukan.');
        }
        return view('admin.quis.evaluasi_detail', compact('materi'));
    }
}
