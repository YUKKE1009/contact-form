<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| お問い合わせフォーム（一般）
|--------------------------------------------------------------------------
*/

Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

/*
|--------------------------------------------------------------------------
| 管理画面（要ログイン）
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // PG04 & PG05: 一覧表示と検索（同じメソッドで処理）
    Route::get('/admin', [ContactController::class, 'admin'])->name('admin.index');
    Route::get('/admin/search', [ContactController::class, 'admin'])->name('admin.search');

    // PG07: 削除（詳細モーダルからの送信先）
    // JavaScriptで設定した /admin/delete/ID に対応
    Route::delete('/admin/delete/{id}', [ContactController::class, 'destroy'])->name('admin.destroy');

    // PG11: エクスポート
    Route::get('/export', [ContactController::class, 'export'])->name('admin.export');
});
