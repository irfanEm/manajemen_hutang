<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function index()
    {
        //
    }

    public function login()
    {
        $data = [
            'title' => 'Login User'
        ];

        return view('auths/login', $data);
    }

    public function doLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if(!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Email atau password salah !');
        }

        session()->set([
            'user_id' => $user['id'],
            'user_name' => $user['nama'],
            'user_email' => $user['email'],
            'logged_in' => true,
        ]);

        return redirect()->to('/dashboard')->with("message", "Login berhasil, Selamat datang di Dashboard {$user['nama']}");
    }
}
