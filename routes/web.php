<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Livewire\Admin\Setting\Pendidikan\ListPendidikan;
use App\Http\Livewire\Admin\Setting\Pengguna\ListPengguna;
use App\Http\Livewire\Admin\Setting\Pengguna\Roles;
use App\Http\Livewire\Admin\Setting\Pengguna\Permission;
use App\Http\Livewire\Admin\Setting\Satuan\ListSatuan;
use App\Http\Livewire\Admin\Setting\Tingkat\ListTingkat;
use App\Http\Livewire\Admin\Setting\Aplikasi\UpdateSetting;
use App\Http\Livewire\Admin\Master\Asatidz\ListAsatidz;
use App\Http\Livewire\Admin\Master\Asatidz\ImportDataAsatidz;
use App\Http\Livewire\Admin\Master\Asatidz\ProfilAsatidz;
use App\Http\Livewire\Admin\Master\Santri\ListSantri;
use App\Http\Livewire\Admin\Master\Santri\ImportDataSantri;
use App\Http\Livewire\Admin\Master\Santri\ProfilSantri;
use App\Http\Livewire\Admin\Master\Jurusan\ListJurusan;
use App\Http\Livewire\Admin\Master\Rombel\DetailRombel;
use App\Http\Livewire\Admin\Akademik\Rombel\ListRombel;
use App\Http\Livewire\Admin\Akademik\Mapel\ListMapel;
use App\Http\Livewire\Admin\Keuangan\Rencana\ListRencanaPemasukan;
use App\Http\Livewire\Admin\Keuangan\Pemasukan\ListPemasukanSantri;
use App\Http\Livewire\Admin\Keuangan\Pemasukan\DetailPemasukanSantri;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);


Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::group(['middleware' => ['role:Admin']], function() {
        Route::get('/setting/roles', Roles::class)->name('setting.roles');
        Route::get('/setting/pendidikan', ListPendidikan::class)->name('setting.pendidikan');
        Route::get('/setting/pengguna', ListPengguna::class)->name('setting.pengguna');
        Route::get('/setting/satuan', ListSatuan::class)->name('setting.satuan');
        Route::get('/setting/tingkat', ListTingkat::class)->name('setting.tingkat');
        Route::get('/setting/aplikasi', UpdateSetting::class)->name('setting.aplikasi');
        Route::get('/master/asatidz', ListAsatidz::class)->name('master.asatidz');
        Route::get('/master/asatidz/import', ImportDataAsatidz::class)->name('master.asatidz.import');
        Route::get('/master/asatidz/profil/{id}', ProfilAsatidz::class)->name('master.asatidz.profil');
        Route::get('/master/santri', ListSantri::class)->name('master.santri');
        Route::get('/master/santri/import', ImportDataSantri::class)->name('master.santri.import');
        Route::get('/master/santri/profil/{id}', ProfilSantri::class)->name('master.santri.profil');
        Route::get('/master/jurusan', ListJurusan::class)->name('master.jurusan');
        Route::get('/master/rombel', ListRombel::class)->name('master.rombel');
        Route::get('/master/rombel/detail/{id}', DetailRombel::class)->name('master.rombel.detail');
        Route::get('/master/mapel', ListMapel::class)->name('master.mapel');
        Route::get('/keuangan/rencana/pemasukan', ListRencanaPemasukan::class)->name('keuangan.rencana.pemasukan');
        Route::get('/keuangan/pemasukan/pemasukansantri', ListPemasukanSantri::class)->name('keuangan.pemasukan.pemasukansantri');
        Route::get('/keuangan/pemasukan/detail/pemasukansantri/{id}', DetailPemasukanSantri::class)->name('keuangan.pemasukan.detail.pemasukansantri');
    });
});



