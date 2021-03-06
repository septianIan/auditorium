<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * jika level admin akan di arahkan ke url /administator
     * jika level katua akan di arahkan ke url /ketua
     */
    public function redirectTo()
    {   
        
        if (auth()->user()->hasRole('admin')) {
            return '/administator';
        } elseif(auth()->user()->hasRole('ketua')){
            return '/ketua';
        } else {
            return $this->redirectTo;
        }
    }
}
