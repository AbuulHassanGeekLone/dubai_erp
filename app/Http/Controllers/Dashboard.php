<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Dashboard';

        return view('dashboard', $data);
    }

    public function login(Request $request)
    {
        $data['title'] = 'Login';

        return view('login', $data);
    }
}
