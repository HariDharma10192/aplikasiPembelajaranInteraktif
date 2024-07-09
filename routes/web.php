<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\MusBeLoggedin;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserQuisController;
use App\Http\Controllers\AdminQuisController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\UserMateriController;
use App\Http\Controllers\AdminMateriController;
use App\Http\Controllers\AdminLaporanController;


Route::get('/', [AuthController::class, 'showHomepage']);

/// USER ROUTES;
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'signIn']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'signIn']);

Route::get('/register', [AuthController::class, 'showRegistrationForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/sign-out', [AuthController::class, 'signOut'])->name('logout');


// HOMEPAGE RELATED ROUTES

// Route::get('/evaluasi', [PageController::class, 'showEvaluasi'])->middleware(MusBeLoggedin::class);
// Route::get('/laporan', [PageController::class, 'showLaporan'])->middleware(MusBeLoggedin::class);
// Route::get('/petunjuk', [PageController::class, 'showPetunjuk'])->middleware(MusBeLoggedin::class);
// Route::get('/kompetensi', [PageController::class, 'showKompetensi'])->middleware(MusBeLoggedin::class);
// Route::get('/laporan', [PageController::class, 'showLaporan'])->middleware(MusBeLoggedin::class);
// Route::get('/materi1', [PageController::class, 'showMateri1'])->middleware(MusBeLoggedin::class);


Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');
        Route::get('/admin/materi/create', [AdminMateriController::class, 'create'])->name('admin.materi.create');
        Route::post('/admin/materi', [AdminMateriController::class, 'store'])->name('admin.materi.store');
        Route::get('/admin/materi', [AdminMateriController::class, 'show'])->name('admin.materi.index');
        Route::delete('/admin/materi/{id}', [AdminMateriController::class, 'destroy'])->name('admin.materi.destroy');
        Route::get('/admin/quis/create', [AdminQuisController::class, 'create'])->name('admin.quis.create');
        Route::post('/admin/quis', [AdminQuisController::class, 'store'])->name('admin.quis.store');
        Route::get('/admin/quis', [AdminQuisController::class, 'index'])->name('admin.quis.index');
        Route::get('/admin/quis/evaluasi', [AdminQuisController::class, 'evaluasi'])->name('admin.quis.evaluasi');
        Route::get('/admin/quis/evaluasi/{materi_id}', [AdminQuisController::class, 'showEvaluasi'])->name('admin.quis.evaluasi.detail');
        // Route::resource('/admin/users', AdminUserController::class);
        Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('/admin/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');
        Route::get('/admin/laporan/data/{materi_id}', [AdminLaporanController::class, 'getLaporanData'])->name('admin.laporan.data');

        Route::get('/admin/petunjuk', function () {
            return view('admin.petunjuk');
        })->name('admin.petunjuk');
    });

    Route::middleware(['user'])->group(function () {
        Route::get('/evaluasi', [PageController::class, 'showEvaluasi']);
        Route::get('/laporan', [PageController::class, 'showLaporan']);
        Route::get('/petunjuk', [PageController::class, 'showPetunjuk']);
        Route::get('/kompetensi', [PageController::class, 'showKompetensi']);
        Route::get('/laporan', [PageController::class, 'showLaporan']);
        Route::get('/materi1', [PageController::class, 'showMateri1']);

        Route::get('/users', [UserController::class, 'index'])->name('user.home');
        Route::get('/users/materi', [UserMateriController::class, 'index'])->name('users.materi.index');
        Route::get('/users/materi/{id}/materi1', [UserMateriController::class, 'showMateri1'])->name('users.materi.materi1');
        Route::get('/users/materi2', [UserMateriController::class, 'materi2Index'])->name('users.materi.materi2');
        Route::get('/users/materi/{id}/materi2', [UserMateriController::class, 'showMateri2'])->name('users.materi.materi2.show');
        Route::get('/users/quis', [UserQuisController::class, 'index'])->name('users.quis.index');
        Route::get('/users/quis/{materi}', [UserQuisController::class, 'show'])->name('users.quis.show');
        Route::post('/users/quis/submit', [UserQuisController::class, 'submitQuis'])->name('users.quis.submit');
        Route::get('/users/laporan', [UserQuisController::class, 'laporan'])->name('users.quis.laporan');
        Route::get('/users/quis/laporan/{materi}', [UserQuisController::class, 'laporanDetail'])->name('users.quis.laporan.detail');
    });
});

route::get('/logoutfast', [AuthController::class, 'logoutfast'])->name('logoutfast');
// Route::get('/materi1', function () {
//     $filePath = 'assetku/bab1.pdf';
//     if (Storage::exists($filePath)) {
//         return response()->file(storage_path('app/' . $filePath));
//     } else {
//         abort(404, 'File not found');
//     }
// });
