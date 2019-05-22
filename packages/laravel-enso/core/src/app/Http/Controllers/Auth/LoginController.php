<?php

namespace LaravelEnso\Core\app\Http\Controllers\Auth;

use Illuminate\Http\Request;
use LaravelEnso\Core\app\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Auth\LoginController as Controller;

use Illuminate\Support\Str;
use App\AuthCode;

class LoginController extends Controller
{
  use AuthenticatesUsers;

  public function __construct()
  {
    $this->middleware('guest')->except('logout');
    $this->maxAttempts = config('enso.auth.maxLoginAttempts');
  }

  protected $redirectTo = '/';

  protected function attemptLogin(Request $request)
  {
    $user = User::whereEmail($request->input('email'))
      ->first();

    if (is_null($user) || !$user->isCurrentPassword($request->input('password'))) {
      return false;
    }

    if ($user->passwordExpired()) {
      throw new AuthenticationException(__(
        'Your password has expired. Please use the reset password form to set a new one'
      ));
    }

    if ($user->isDisabled()) {
      throw new AuthenticationException(__(
        'Your account has been disabled. Please contact the administrator'
      ));
    }

    auth()->login($user, $request->input('remember'));

    return true;
  }

  protected function authCodeCheck(Request $request, $user)
  {
    $code = AuthCode::firstOrCreate([
      'user_id' => $user->id,
      'ip' => $request->ip(),
    ], [
      'code' => strtoupper(Str::random(8))
    ]);
    return $code;
    // $code->ip = $request->ip();
    // $code->save();
  }

  protected function authenticated(Request $request, $user)
  {
    return response()->json([
      'auth' => false,
      // 'auth' => auth()->check(),
      'csrfToken' => csrf_token(),
      'ipConfirmed' => $this->authCodeCheck($request, $user)['confirmed']
    ]);
  }

  public function logout(Request $request)
  {
    $this->guard()->logout();

    $request->session()->invalidate();
  }

  public function authCode(Request $request)
  {
    return response()->json([
      'code' => $request->input('authCode'),
      'test' => true,
    ]);
  }

}
