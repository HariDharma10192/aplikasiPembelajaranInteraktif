<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function showLaporan()
    {
        return view('users.laporan');
    }
    public function showPetunjuk()
    {
        return view('users.petunjuk');
    }
    public function showKompetensi()
    {
        return view('users.kompetensi');
    }
    public function showEvaluasi()
    {
        $headerText = "Evaluasi";
        return view('users.evaluasi', compact('headerText'))->with(["headerText" => $headerText]);
    }
    public function showMateri1()
    {
        return view('users.materi1', ['pdfUrl' => url('storage/assetku/bab1.pdf')]);
    }
}
