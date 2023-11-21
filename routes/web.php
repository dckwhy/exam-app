<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Parent\ChildController;
// Admin
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\TierController as AdminTierController;
use App\Http\Controllers\Admin\TryOutController as AdminTryOutController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;
// Parent
use App\Http\Controllers\Parent\ProfileController as ParentProfileController;
use App\Http\Controllers\Parent\TierController as ParentTierController;
use App\Http\Controllers\Parent\TryOutController as ParentTryOutController;
// Child
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Student\TierController as StudentTierController;
use App\Http\Controllers\Student\TryOutController as StudentTryOutController;
use App\Http\Controllers\Student\TeacherController as StudentTeacherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn () => redirect()->route('login'));

Route::get('/unauthorized', function () {
    return view('auth.403');
})->name('unauthorized');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::group(['middleware' => 'role:admin'], function () {
        Route::resource('admin/profile', AdminProfileController::class, ['as' => 'admin']);
        // TryOut
        Route::get('admin/nilai/{id}/try-out/{try_out_id}', [AdminTryOutController::class, 'indexGrade'])->name('admin.tingkat.try-out.grade');
        Route::get('admin/nilai/{id}/try-out', [AdminTryOutController::class, 'indexTryOut'])->name('admin.tingkat.try-out');
        Route::get('admin/try-out/{id}/pertanyaan', [AdminTryOutController::class, 'question'])->name('admin.try-out.question');
        Route::get('admin/try-out/{id}/aktifkan', [AdminTryOutController::class, 'activate'])->name('admin.try-out.activate');
        Route::get('admin/try-out/{id}/nonaktifkan', [AdminTryOutController::class, 'deactivate'])->name('admin.try-out.deactivate');
        Route::resource('admin/try-out', AdminTryOutController::class, ['as' => 'admin']);
        // Tier
        Route::get('admin/nilai', [AdminTierController::class, 'indexTier'])->name('admin.tingkat.grade');
        Route::get('admin/pendaftar/{id}/validasi', [AdminTierController::class, 'agreed'])->name('admin.pendaftar.agreed');
        Route::get('admin/pendaftar/{id}/detail', [AdminTierController::class, 'detail'])->name('admin.pendaftar.detail');
        Route::get('admin/pendaftar', [AdminTierController::class, 'registered'])->name('admin.pendaftar.registered');
        Route::get('admin/tingkat/{id}/aktifkan', [AdminTierController::class, 'activate'])->name('admin.tingkat.activate');
        Route::get('admin/tingkat/{id}/nonaktifkan', [AdminTierController::class, 'deactivate'])->name('admin.tingkat.deactivate');
        Route::get('admin/financial', [AdminTierController::class, 'financial'])->name('admin.report.index');
        Route::get('admin/history', [AdminTierController::class, 'historyTier'])->name('admin.tingkat.history');
        Route::resource('admin/tingkat', AdminTierController::class, ['as' => 'admin']);
        // Question
        Route::get('admin/pertanyaan/{id}/aktifkan', [AdminQuestionController::class, 'activate'])->name('admin.pertanyaan.activate');
        Route::get('admin/pertanyaan/{id}/nonaktifkan', [AdminQuestionController::class, 'deactivate'])->name('admin.pertanyaan.deactivate');
        Route::resource('admin/pertanyaan', AdminQuestionController::class, ['as' => 'admin']);
    });
    Route::group(['middleware' => 'role:parent'], function () {
        Route::resource('orang-tua/profile', ParentProfileController::class, ['as' => 'orang-tua']);
        // TryOut
        Route::get('orang-tua/anak/{child_id}/nilai/{id}/try-out/{try_out_id}/export', [ParentTryOutController::class, 'export'])->name('orang-tua.kelas.grade.try-out.export');
        Route::get('orang-tua/anak/{child_id}/nilai/{id}/try-out/{try_out_id}', [ParentTryOutController::class, 'indexGrade'])->name('orang-tua.kelas.grade.try-out.detail');
        Route::get('orang-tua/anak/{child_id}/nilai/{id}/try-out', [ParentTryOutController::class, 'indexTryOut'])->name('orang-tua.kelas.grade.try-out');
        // Tier
        Route::get('orang-tua/anak/{id}/nilai', [ParentTierController::class, 'indexTier'])->name('orang-tua.kelas.grade');
        Route::get('orang-tua/anak/kelas/{id}/detail', [ParentTierController::class, 'detail'])->name('orang-tua.anak.detail');
        Route::post('orang-tua/anak/kelas', [ParentTierController::class, 'payment'])->name('orang-tua.anak.payment');
        Route::get('orang-tua/anak/kelas/{id}/bukti-pembayaran', [ParentTierController::class, 'proofOfPayment'])->name('orang-tua.anak.proof-of-payment');
        Route::get('orang-tua/anak/kelas', [ParentTierController::class, 'registered'])->name('orang-tua.anak.registered');
        // Child
        Route::get('orang-tua/anak/nilai', [ChildController::class, 'indexChild'])->name('orang-tua.grade');
        Route::resource('orang-tua/anak', ChildController::class, ['as' => 'orang-tua']);
    });
    Route::group(['middleware' => 'role:student'], function () {
        Route::resource('siswa/profile', StudentProfileController::class, ['as' => 'siswa']);
        // Teacher
        Route::get('siswa/pengajar', [StudentTeacherController::class, 'index'])->name('siswa.pengajar.index');
        // TryOut
        Route::get('siswa/nilai/try-out/{try_out_id}', [StudentTryOutController::class, 'indexGrade'])->name('siswa.kelas.grade.try-out.detail');
        Route::get('siswa/nilai/{id}/try-out', [StudentTryOutController::class, 'indexTryOut'])->name('siswa.kelas.grade.try-out');
        Route::post('siswa/kelas/try-out', [StudentTryOutController::class, 'store'])->name('siswa.kelas.try-out.store');
        Route::get('siswa/try-out/{id}', [StudentTryOutController::class, 'create'])->name('siswa.kelas.try-out.create');
        Route::get('siswa/kelas/terdaftar/{id}/try-out', [StudentTryOutController::class, 'index'])->name('siswa.kelas.try-out.index');
        // Tier
        Route::get('siswa/nilai', [StudentTierController::class, 'indexTier'])->name('siswa.kelas.grade');
        Route::get('siswa/kelas/terdaftar', [StudentTierController::class, 'indexRegistered'])->name('siswa.kelas.index-registered');
        Route::post('siswa/kelas', [StudentTierController::class, 'store'])->name('siswa.kelas.store');
        Route::get('siswa/kelas', [StudentTierController::class, 'index'])->name('siswa.kelas.index');
    });
});
