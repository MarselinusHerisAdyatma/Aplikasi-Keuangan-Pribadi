<?php

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
    return view('home.index');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Rute-rute admin di sini
    Route::get('/admin/listuser', [AdminController::class, 'listuser'])->name('admin.listuser');
    Route::get('/admin/manageuser/{id}', [AdminController::class, 'manageuser'])->name('admin.manageuser');
    Route::post('/admin/postmanageuser/{id}', [AdminController::class, 'postmanageuser'])->name('admin.postmanageuser');
});


Route::get('/login', 'AuthController@login')->name('login');
Route::get('/register', 'AuthController@register')->name('register');
Route::get('/logout', 'AuthController@logout');
Route::post('/postLogin', 'AuthController@postLogin');
Route::post('/postRegister', 'AuthController@postRegister');

Route::group(['middleware' => []], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/income-chart', 'PemasukanController@showIncomeChart');

    Route::get('/pemasukan', 'PemasukanController@index');
    Route::post('/pemasukan/add', 'PemasukanController@add');
    Route::get('/pemasukan/{id}/delete', 'PemasukanController@delete');
    Route::get('/pemasukan/{id}/edit', 'PemasukanController@edit');
    Route::post('/pemasukan/{id}/update', 'PemasukanController@update');
    Route::match(array('GET', 'POST'), '/pemasukan/filter', 'PemasukanController@filter');
    Route::match(array('GET', 'POST'), '/pemasukan/print', 'PemasukanController@print');

    Route::get('/pengeluaran', 'PengeluaranController@index');
    Route::post('/pengeluaran/add', 'PengeluaranController@add');
    Route::get('/pengeluaran/{id}/delete', 'PengeluaranController@delete');
    Route::get('/pengeluaran/{id}/edit', 'PengeluaranController@edit');
    Route::post('/pengeluaran/{id}/update', 'PengeluaranController@update');
    Route::match(array('GET', 'POST'), '/pengeluaran/filter', 'PengeluaranController@filter');
    Route::match(array('GET', 'POST'), '/pengeluaran/print', 'PengeluaranController@print');

    Route::get('/wishlist', 'WishlistController@index');
    Route::post('wishlist/add', 'WishlistController@add');
    Route::get('/wishlist/{id}/edit', 'WishlistController@edit');
    Route::post('/wishlist/{id}/postEdit', 'WishlistController@postEdit');
    Route::get('/wishlist/{id}/delete', 'WishlistController@delete');
    Route::match(array('GET', 'POST'), '/wishlist/filter', 'WishlistController@filter');
    Route::match(array('GET', 'POST'), '/wishlist/print', 'WishlistController@print');

    Route::get('/asuransi', 'AsuransiController@index');
    Route::post('asuransi/add', 'AsuransiController@add');
    Route::get('/asuransi/{id}/edit', 'AsuransiController@edit');
    Route::post('/asuransi/{id}/postEdit', 'AsuransiController@postEdit');
    Route::get('/asuransi/{id}/delete', 'AsuransiController@delete');
    Route::match(array('GET', 'POST'), '/asuransi/filter', 'AsuransiController@filter');
    Route::match(array('GET', 'POST'), '/asuransi/print', 'AsuransiController@print');

    Route::get('/hutang', 'HutangController@index');
    Route::post('/hutang/add', 'HutangController@add');
    Route::get('/hutang/{id}/delete', 'HutangController@delete');
    Route::get('/hutang/{id}/edit', 'HutangController@edit');
    Route::post('/hutang/{id}/update', 'HutangController@update');
    Route::match(array('GET', 'POST'), '/hutang/filter', 'HutangController@filter');
    Route::match(array('GET', 'POST'), '/hutang/print', 'HutangController@print');

    Route::get('/investasi', 'InvestasiController@index');
    Route::post('/investasi/add', 'InvestasiController@add');
    Route::get('/investasi/{id}/delete', 'InvestasiController@delete');
    Route::get('/investasi/{id}/edit', 'InvestasiController@edit');
    Route::post('/investasi/{id}/update', 'InvestasiController@update');
    Route::match(array('GET', 'POST'), '/investasi/filter', 'InvestasiController@filter');
    Route::match(array('GET', 'POST'), '/investasi/print', 'InvestasiController@print');

    Route::get('/akun_keuangan', 'AkunKeuanganController@index');
    Route::post('/akun_keuangan/add', 'AkunKeuanganController@add');
    Route::get('/akun_keuangan/{id}/delete', 'AkunKeuanganController@delete');
    Route::get('/akun_keuangan/{id}/edit', 'AkunKeuanganController@edit');
    Route::post('/akun_keuangan/{id}/update', 'AkunKeuanganController@update');
    Route::match(array('GET', 'POST'), '/akun_keuangan/filter', 'AkunKeuanganController@filter');
    Route::match(array('GET', 'POST'), '/akun_keuangan/print', 'AkunKeuanganController@print');

    Route::get('/tabungan', 'TabunganController@index');
    Route::post('/tabungan/add', 'TabunganController@add');
    Route::get('/tabungan/{id}/delete', 'TabunganController@delete');
    Route::get('/tabungan/{id}/edit', 'TabunganController@edit');
    Route::post('/tabungan/{id}/update', 'TabunganController@update');
    Route::match(array('GET', 'POST'), '/tabungan/filter', 'TabunganController@filter');
    Route::match(array('GET', 'POST'), '/tabungan/print', 'TabunganController@print');

    Route::get('/user/changepassword', 'UserController@changepassword');
    Route::post('/user/postchangepassword', 'UserController@postchangepassword');
});

Route::group(['middleware' => ['auth', 'roleCheck:admin']], function () {
    Route::get('/admin/listuser', 'AdminController@listuser');
    Route::get('/admin/user/{id}/manage', 'AdminController@manageuser');
    Route::post('/admin/user/{id}/postManage', 'AdminController@postmanageuser');
});
