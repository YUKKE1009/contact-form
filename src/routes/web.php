<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// お問い合わせフォーム
Route::get('/', [ContactController::class, 'showForm']);          // PG01
Route::post('/confirm', [ContactController::class, 'confirm']);   // PG02
Route::post('/thanks', [ContactController::class, 'send']);       // PG03

// 管理画面・検索・削除
Route::get('/admin', [AdminController::class, 'index']);          // PG04
Route::get('/search', [AdminController::class, 'search']);        // PG05
Route::get('/reset', [AdminController::class, 'reset']);          // PG06
Route::delete('/delete', [AdminController::class, 'delete']);     // PG07

// ユーザ認証
Route::get('/register', [AuthController::class, 'showRegister']); // PG08
Route::post('/register', [AuthController::class, 'register']);    // PG08 送信
Route::get('/login', [AuthController::class, 'showLogin']);       // PG09
Route::post('/login', [AuthController::class, 'login']);          // PG09 送信
Route::post('/logout', [AuthController::class, 'logout']);        // PG10

// エクスポート
Route::get('/export', [AdminController::class, 'export']);        // PG11
