<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| お問い合わせフォーム（一般）
|--------------------------------------------------------------------------
| 一般ユーザーが利用する入力・確認・完了のルートです。
*/

Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

/*
|--------------------------------------------------------------------------
| 管理画面（要ログイン）
|--------------------------------------------------------------------------
| 管理者のみがアクセスできる一覧・検索・削除・エクスポートのルートです。
| すべて AdminController に集約することで、検索結果とエクスポート内容を一致させます。
*/
Route::middleware(['auth'])->group(function () {
    // 一覧表示および検索結果の表示
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/search', [AdminController::class, 'index'])->name('admin.search');

    // 詳細モーダルからの削除機能
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');

    // 検索結果に基づいたCSVエクスポート
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
});
