<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| お問い合わせ（一般ユーザー）
|--------------------------------------------------------------------------
*/
Route::get('/', [ContactController::class, 'index']);          // PG01 入力画面
Route::post('/confirm', [ContactController::class, 'confirm']); // PG02 確認画面
Route::post('/thanks', [ContactController::class, 'store']);    // PG03 保存 → サンクス
Route::get('/thanks', [ContactController::class, 'thanks']);         // サンクス画面表示
/*
|--------------------------------------------------------------------------
| 管理画面
|--------------------------------------------------------------------------
*/
Route::get('/admin', [AdminController::class, 'index']);        // PG04 一覧表示
Route::get('/search', [AdminController::class, 'search']);     // PG05 検索
Route::get('/reset', [AdminController::class, 'reset']);       // PG06 検索リセット
Route::post('/delete', [AdminController::class, 'destroy']);   // PG07 削除
Route::get('/export', [AdminController::class, 'export']);     // PG11 エクスポート
