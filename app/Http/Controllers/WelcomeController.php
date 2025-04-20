<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index() {
        $username = Auth::check() ? Auth::user()->username : 'Guest';

        $breadcrumbs = (object) [ 
            'title' => 'Selamat Datang, ' . $username . ' di Aplikasi POS System', 
            'list' => ['Home', 'Welcome'] 
        ];
        
        $activeMenu = 'dashboard'; 
        return view('welcome', ['breadcrumbs' => $breadcrumbs, 'activeMenu' => $activeMenu]);
    }
}
