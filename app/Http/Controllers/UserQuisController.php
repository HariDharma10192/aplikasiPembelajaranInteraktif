<?php

namespace App\Http\Controllers;

use App\Models\UserJawabQuis;
use App\Models\Materi;

use App\Models\Quis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserQuisController extends Controller
{
    // Menampilkan daftar materi dengan kuis
    // public function index(Request $request)
    // {
    //     $query = Materi::query();

    //     if ($request->has('search')) {
    //         $query->where('judul', 'like', '%' . $request->search . '%');
    //     }

    //     $materis = $query->orderBy('created_at', 'desc')->paginate(5);

    //     return view('users.quis.index', compact('materis'));
    // }
    public function index(Request $request)
    {
        $query = Materi::query();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $materis = $query->orderBy('created_at', 'desc')->paginate(5);

        // Get the current user's ID
        $userId = Auth::id();

        // Fetch the user's completed quizzes
        $completedQuizzes = UserJawabQuis::where('user_id', $userId)
            ->pluck('materi_id')
            ->toArray();

        return view('users.quis.index', compact('materis', 'completedQuizzes'));
    }


    // Menampilkan pertanyaan kuis berdasarkan materi
    public function show($materi_id)
    {
        $user = auth()->user();
        $materi = Materi::with('quis')->findOrFail($materi_id);
        $userJawabQuis = UserJawabQuis::where('user_id', $user->id)
            ->where('materi_id', $materi_id)
            ->first();

        return view('users.quis.show', compact('materi', 'userJawabQuis'));
    }


    public function submitQuis(Request $request)
    {
        $user = auth()->user();
        $materi_id = $request->input('materi_id');
        $answers = $request->input('answers'); // ['question_id' => 'answer']

        $total_questions = count($answers);
        $correct_answers = 0;

        foreach ($answers as $question_id => $answer) {
            $question = Quis::find($question_id);
            if ($question && $question->correct_answer == $answer) {
                $correct_answers++;
            }
        }

        $nilai = ($correct_answers / $total_questions) * 100;

        UserJawabQuis::create([
            'user_id' => $user->id,
            'materi_id' => $materi_id,
            'nilai' => $nilai,
            'total_questions' => $total_questions,
            'correct_answers' => $correct_answers,
        ]);

        return redirect()->route('users.quis.index')->with('success', 'Kuis berhasil disubmit!');
    }
    // Menampilkan halaman laporan
    public function laporan()
    {
        $materis = Materi::all();
        return view('users.quis.laporan', compact('materis'));
    }

    // Menampilkan detail nilai untuk materi yang dipilih
    public function laporanDetail($materi_id)
    {
        $user = auth()->user();
        $materi = Materi::findOrFail($materi_id);
        $userJawabQuis = UserJawabQuis::where('user_id', $user->id)
            ->where('materi_id', $materi_id)
            ->first();

        return response()->json([
            'materi' => $materi,
            'userJawabQuis' => $userJawabQuis
        ]);
    }


    // Menampilkan detail nilai untuk materi yang dipilih
    // public function laporanDetail($materi_id)
    // {
    //     $user = auth()->user();
    //     $materi = Materi::findOrFail($materi_id);
    //     $userJawabQuis = UserJawabQuis::where('user_id', $user->id)
    //         ->where('materi_id', $materi_id)
    //         ->first();

    //     return view('users.quis.laporan_detail', compact('materi', 'userJawabQuis'));
    // }
}
