<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login() {
        return response()
            ->view('user.login', 
            [
                'title' => 'Login Page'
            ]);
    }

    public function doLogin(Request $request): Response|RedirectResponse {
        $user = $request->input("user");
        $passwd = $request->input("password");

        // validate input
        if (empty($user) || empty($passwd)) {
            return response()->view('user.login',
            [
                'title' => 'Login Page', 
                'error' => 'user or password is required'
            ]);
        }

        // cek 
        if ($this->userService->login($user, $passwd)) {
            $request->session()->put('user', $user);
            return redirect('/');
        }
        Alert::success('Berhasil!', 'berhaisl'); //'Post Created Successfully');

        return response()->view('user.login',
        [
            'title' => 'Login Page',
            'error' => 'user or password is wrong'
        ]);
    }

    public function doLogout(request $request) {
        $request->session()->forget("user");
        Alert::success('Berhasil!', ''); //'Post Created Successfully');
        return redirect("/");
        
    }
}
