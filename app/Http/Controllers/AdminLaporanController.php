<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\UserJawabQuis;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller
{
    public function index()
    {
        $materis = Materi::all();
        return view('admin.laporan.index', compact('materis'));
    }

    public function getLaporanData($materi_id)
    {
        $materi = Materi::findOrFail($materi_id);
        $userJawabQuis = UserJawabQuis::where('materi_id', $materi_id)->get();

        $data = $userJawabQuis->map(function ($item) {
            return [
                'user' => $item->user->name,
                'nilai' => $item->nilai,
            ];
        });

        return response()->json([
            'materi' => $materi,
            'data' => $data,
        ]);
    }
}
