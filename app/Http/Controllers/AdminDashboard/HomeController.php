<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}
