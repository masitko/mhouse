<?php

namespace LaravelEnso\Core\app\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use LaravelEnso\Core\app\Models\User;
use LaravelEnso\Core\app\Notifications\AuthCodeNotification;

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
    $authCode = AuthCode::firstOrCreate([
      'user_id' => $user->id,
      'ip' => $request->ip(),
    ], [
      'code' => strtoupper(Str::random(8)),
      'confirmed' => false
    ]);

    if( !$authCode->confirmed ) {
      $user->notify(new AuthCodeNotification($authCode->code));
    }

    return $authCode;
  }

  protected function authenticated(Request $request, $user)
  {
    $authCheck = $this->authCodeCheck($request, $user);
    return response()->json([
      'auth' => false,
      // 'auth' => auth()->check(),
      'csrfToken' => csrf_token(),
      // 'authCode' => $authCheck['code'],
      'ipConfirmed' => (Boolean)$authCheck['confirmed']
    ]);
  }

  public function logout(Request $request)
  {
    $this->guard()->logout();

    $request->session()->invalidate();
  }

  public function authCode(Request $request)
  {
    $code = $request->input('authCode');
    $user = auth()->user();
    if (!$user) {
      throw new AuthenticationException(__(
        'PLease try to log-in again.'
      ));
    }

    $authCode = AuthCode::where('user_id', $user->id)
      ->where('ip', $request->ip())
      ->first();
    if ($code === $authCode->code) {
      $authCode->confirmed = true;
      $authCode->save();
    } else {
      throw new AuthenticationException(__(
        'Wrong code, please try again.'
      ));
    }

    return response()->json([
      'csrfToken' => csrf_token(),
      'ipConfirmed' => $authCode->confirmed
    ]);
  }
}
