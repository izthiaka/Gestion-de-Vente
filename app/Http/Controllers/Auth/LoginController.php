<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Login username to be used by the controller.
     *
     * @var string
     */
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUserlogin();
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUserlogin()
    {
        $identifiant = request()->input('identifiant');
        $fieldType = filter_var($identifiant, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';
        request()->merge([$fieldType => $identifiant]);

        return $fieldType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * Get a validator for an incoming login request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'exists:users,' . $this->username() . ',is_active,1',
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['is_active' => true]);
    }

    protected function redirectTo()
    {
        $user = Auth::user();
        $admin = Role::where('code_role',  'AD')->first();
        $agent = Role::where('code_role',  'AG')->first();

        if($user->role_id == $admin->id)
        {
            if($user->password_change_at == null){
                return '/admin/change-password';
            }else{
                return '/admin/dashboard';
            }
        }

        elseif($user->role_id  == $agent->id)
        {
            if($user->password_change_at == null){
                return '/change-password';
            }else{
                return '/dashboard';
            }
        }

    }
}
