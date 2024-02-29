<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogoutAdminController;
use App\Http\Controllers\ReportController;

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

Route::get('/app', function () {
    return view('app');
});
Route::get('/learn', function () {
    return view('learn');
});
//album



Route::middleware('guest')->group(function () {
    Route::get('/homepage', [Controller::class, 'homepage'])->name('homepage');

    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/cek_log', [LoginController::class, 'cek_log'])->name('cek_log');

    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/cek_register', [RegisterController::class, 'cek_register'])->name('cek_register');
});




//user
Route::middleware('user')->group(function () {
    //comment
    Route::get('/comment/{id}', [CommentController::class, 'comment'])->name('comment');

    Route::get('/comment/{id}/getdatadetail', [CommentController::class, 'getdatadetail'])->name('getdatadetail');
    Route::get('/comment/getComment/{id}', [CommentController::class, 'ambildatakomentar'])->name('ambildatakomentar');
    //kirim komentar
    Route::post('/comment/kirimkomentar', [CommentController::class, 'kirimkomentar'])->name('kirimkomentar');
    //follow
    Route::post('/comment/ikuti', [CommentController::class, 'ikuti'])->name('ikuti');




    Route::get('/index', [UserController::class, 'index'])->name('index');
    //javascript
    Route::get('/getDataIndex', [UserController::class, 'getdata'])->name('getdata');
    Route::post('/like', [UserController::class, 'like'])->name('like');
    //endjavascript

    //profile user
    Route::get('/profil', [ProfileController::class, 'profil'])->name('profil');
    Route::get('/profil/getDataProfil', [ProfileController::class, 'profil'])->name('profil');

    //menampilkan profile user lain
    Route::get('/profil_other/{id}', [ProfileController::class, 'profil_other'])->name('profil_other');
    Route::get('/profil_other/getDataProfil/{id}', [ProfileController::class, 'getDataProfil'])->name('getDataProfil');
    Route::get('/getdataprofilother/', [ProfileController::class, 'getdataprofilother']);

    //album
    Route::get('/album/{id}', [ProfileController::class, 'show'])->name('album.show');

    Route::post('/up_fotoprofile', [ProfileController::class, 'up_fotoprofile'])->name('up_fotoprofile');

    //profile
    Route::get('/edit_profile', [ProfileController::class, 'edit_profile'])->name('edit_profile');
    Route::post('up_profile', [ProfileController::class, 'up_profile'])->name('up_profile');
    //end profile


    //password
    Route::post('up_password', [ProfileController::class, 'up_password'])->name('up_password');
    //end password


    //upload and album
    Route::get('/upload', [UploadController::class, 'upload'])->name('upload');


    // Display the edit form
    Route::get('/edit_upload/{foto}/edit', [UploadController::class, 'edit_upload'])->name('edit_upload.edit');

    // Handle the form submission to update the photo
    Route::put('/edit_upload/{foto}', [UploadController::class, 'updateFoto'])->name('edit_upload.update');



    // Define the route for displaying uploaded photos
    Route::get('/uploaded', [UploadController::class, 'uploaded'])->name('uploaded');


    //delete foto
    Route::delete('/photos/{foto}', [UploadController::class, 'destroyFoto'])->name('photos.destroy');


    //proses upload foto
    Route::post('save', [UploadController::class, 'save'])->name('save');
    //proses tambah album
    Route::post('/album', [UploadController::class, 'album'])->name('album');
    //end upload and album


    //report
    Route::post('/report/{id}', [ReportController::class, 'report'])->name('report');
    Route::get('/report_foto/{id}', [ReportController::class, 'report_foto'])->name('report_foto');

    //upload foto

    Route::post('/logout', LogoutController::class)->name('logout');
});




//admin
Route::middleware('admin')->group(function () {
    //tampil hal dashboard admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    //tampil hapus akun
    Route::get('/hapus_akun', [AdminController::class, 'hapus_akun'])->name('hapus_akun');
    //tampil profile admin
    Route::get('/profile_admin', [AdminController::class, 'profile_admin'])->name('profile_admin');


    //hapus akun user
    Route::delete('hapus_account/{id}', [AdminController::class, 'hapus_account'])->name('hapus_account');


    //logout admin
    Route::post('/logout_admin', LogoutAdminController::class)->name('logout_admin');

    //delete foto report
    // web.php
    Route::delete('/report/{id}', [ReportController::class, 'destroy'])->name('report.destroy');

    //tampil hapus report
    Route::get('/hapus_report', [AdminController::class, 'hapus_report'])->name('hapus_report');
});
