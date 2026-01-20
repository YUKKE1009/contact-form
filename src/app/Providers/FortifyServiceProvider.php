<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // 会員登録画面のビューを指定
        Fortify::registerView(function () {
            return view('auth.register'); // resources/views/auth/register.blade.php を表示
        });

        // ログイン画面のビューを指定
        Fortify::loginView(function () {
            return view('auth.login'); // resources/views/auth/login.blade.php を表示
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // ログインのバリデーションメッセージをカスタマイズ
        Fortify::authenticateUsing(function (LoginRequest $request) {
            // 1. バリデーションの実行
            $validator = Validator::make($request->all(), [
                'email'    => ['required', 'email:filter'],
                'password' => ['required'],
            ], [
                'email.required'    => 'メールアドレスを入力してください',
                'email.email'       => 'メールアドレスはメール形式で入力してください',
                'password.required' => 'パスワードを入力してください',
            ]);

            // エラーがあれば自動的に前画面にメッセージを持って戻る
            if ($validator->fails()) {
                throw new \Illuminate\Validation\ValidationException($validator);
            }

            // 2. ユーザーの取得とパスワード照合
            $user = \App\Models\User::where('email', $request->email)->first();

            // ユーザーが存在し、パスワードが合致すればユーザーを返してログイン成功
            if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                return $user;
            }

            // 3. ここまで来たら認証失敗（入力自体は正しいが、登録がない場合）
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'ログイン情報が登録されていません',
            ]);
        });
    }
}
