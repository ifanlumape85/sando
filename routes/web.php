<?php


use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PemilihController;
use App\Http\Controllers\Admin\KabupatenController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\KelurahanController;
use App\Http\Controllers\Admin\PropinsiController;
use App\Http\Controllers\Admin\TpsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\StuntingController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/', function () {
    return view('auth.login');
})->name('home');

// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard-stunting');
Route::get('/down', function () {
    Artisan::call('down');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('pemilih/get_data/', [PemilihController::class, 'getData']);
    Route::get('pemilih/get_list_pemilih/{id_tps?}/{id_kelurahan?}', [PemilihController::class, 'getList']);
    Route::get('kabupaten/get_data/', [KabupatenController::class, 'getData']);
    Route::get('kabupaten/get_list_kabupaten/{id}', [KabupatenController::class, 'getList']);
    Route::get('kecamatan/get_data/', [KecamatanController::class, 'getData']);
    Route::get('kecamatan/get_list_kecamatan/{id}', [KecamatanController::class, 'getList']);
    Route::get('kelurahan/get_data/', [KelurahanController::class, 'getData']);
    Route::get('kelurahan/get_list_kelurahan/{id}', [KelurahanController::class, 'getList']);
    Route::get('propinsi/get_data/', [PropinsiController::class, 'getData']);
    Route::get('propinsi/import/', [PropinsiController::class, 'import']);
    Route::get('tps/get_data/', [TpsController::class, 'getData']);
    Route::get('tps/get_list_tps/{id}', [TpsController::class, 'getList']);
    Route::get('stunting/get_data/', [StuntingController::class, 'getData']);

    Route::resource('pemilih', PemilihController::class);
    Route::resource('kabupaten', KabupatenController::class);
    Route::resource('kecamatan', KecamatanController::class);
    Route::resource('kelurahan', KelurahanController::class);
    Route::resource('user', UserController::class);
    Route::resource('propinsi', PropinsiController::class);
    Route::resource('tps', TpsController::class);
    Route::resource('stunting', StuntingController::class);
    Route::resource('roles', RoleController::class);
});
