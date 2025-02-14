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
        $materis = Materi::all();
        $questionCount = old('question_count', 1);
        return view('admin.quis.create', compact('materis', 'questionCount'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
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

        return redirect()->route('admin.quis.index')
            ->withInput($request->all())
            ->with('success', 'Kuis berhasil ditambahkan.');
    }
    public function evaluasi(Request $request)
    {
        $search = $request->input('search');
        $materis = Materi::when($search, function ($query, $search) {
            return $query->where('judul', 'like', "%{$search}%");
        })->paginate(10); // Menggunakan paginate() untuk mengembalikan hasil yang ter-paginate

        return view('admin.quis.evaluasi', compact('materis', 'search'));
    }
    public function showEvaluasi($materi_id)
    {
        $materi = Materi::find($materi_id);
        if (!$materi) {
            return redirect()->route('admin.quis.evaluasi')->with('error', 'Materi tidak ditemukan.');
        }

        $userJawabQuis = UserJawabQuis::with('user')
            ->where('materi_id', $materi_id)
            ->paginate(10);

        return view('admin.quis.evaluasi_detail', compact('materi', 'userJawabQuis'));
    }
}
