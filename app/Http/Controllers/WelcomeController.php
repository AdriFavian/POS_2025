<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\StokModel;
use App\Models\PenjualanModel;
use App\Models\PenjualanDetailModel;
use App\Models\BarangModel;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $username = Auth::check() ? Auth::user()->username : 'Guest';

        $totalStok = StokModel::sum('stok_jumlah');

        // $totalPenjualanHariIni = PenjualanModel::whereDate('created_at', today())
        //     ->sum('total_harga'); 
        $totalPenjualanHariIni = PenjualanModel::sum('total_harga'); 

        // 5 transaksi terakhir
        $transaksiTerakhir = PenjualanModel::with(['user', 'detail.barang'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $breadcrumbs = (object) [
            'title' => 'Selamat Datang, ' . $username,
            'list' => ['Home', 'Dashboard']
        ];

        $activeMenu = 'dashboard';

        return view('welcome', [
            'breadcrumbs' => $breadcrumbs,
            'activeMenu' => $activeMenu,
            'totalStok' => $totalStok,
            'totalPenjualanHariIni' => $totalPenjualanHariIni,
            'transaksiTerakhir' => $transaksiTerakhir
        ]);
    }
}

// class WelcomeController extends Controller
// {
//     public function index() {
//         $username = Auth::check() ? Auth::user()->username : 'Guest';

//         $breadcrumbs = (object) [ 
//             'title' => 'Selamat Datang, ' . $username, 
//             'list' => ['Home', 'Welcome'] 
//         ];
        
//         $activeMenu = 'dashboard'; 
//         return view('welcome', ['breadcrumbs' => $breadcrumbs, 'activeMenu' => $activeMenu]);
//     }
// }
