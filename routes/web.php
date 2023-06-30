<?php

use App\Http\Controllers\CompartilharController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/user'], function () {
    Route::get('', [UserController::class, 'index'])->name('user');

    Route::get('/create', [UserController::class, 'create'])->name('user.create');

    Route::post('/create', [UserController::class, 'createSave']);

    Route::get('/login', [UserController::class, 'login'])->name('user.login');

    Route::post('/login', [UserController::class, 'login']);

    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});

//usar o php artisan make:middleware 'NomeDoMiddleware' para criar rotas pos login
Route::group(['prefix' => '/upload'], function () {

    Route::get('', [UploadController::class, 'index'])->name('upload')->middleware('auth');

    Route::get('/tabela', [UploadController::class, 'tabela'])->name('upload.tabela')->middleware('auth');

    Route::post('/save', [UploadController::class, 'save'])->name('upload.save');

    Route::post('/saverichtext', [UploadController::class, 'saverichtext'])->name('upload.saverichtext');

    Route::get('/buscar', [UploadController::class, 'buscar'])->name('upload.buscar');
    
    Route::get('visualizar/{documento}', [UploadController::class, 'visualizar'])->name('upload.visualizar');

    Route::get('/editar/{documento}', [UploadController::class, 'editar'])->name('upload.editar');

    Route::put('/editar/{documento}', [UploadController::class, 'editarGravar'])->name('upload.editarGravar');

    Route::get('/apagar/{documento}', [UploadController::class, 'apagar'])->name('upload.apagar');

    Route::delete('/apagar/{documento}', [UploadController::class, 'apagar']);

    Route::get('/apagar-fixo/{documentoFixo}', [UploadController::class, 'apagarFixo'])->name('upload.apagarFixo');

    Route::delete('/apagar-fixo/{documentoFixo}', [UploadController::class, 'apagarFixo']);
});

Route::group(['prefix' => '/compartilhar'], function () {

    Route::get('', [CompartilharController::class, 'index'])->name('compartilhar')->middleware('auth');
});
