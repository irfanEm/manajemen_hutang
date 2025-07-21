<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('hello_world');
    }

    public function dashboard()
    {
        return view('dashboard/index', [
            'title' => 'Dashboard',
            'user' => session()->get('user_name')
        ]);
    }
}
