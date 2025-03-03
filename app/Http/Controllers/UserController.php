<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function profile($id, $name)
    // {
    //     return view('user', ['id' => $id, 'name' => $name]);
    // }

    public function index()
    {
        $user = UserModel::findor(20, ['username', 'nama'], function () { 
            abort (404); 
        });
        return view('user', ['data' => $user]);
    }
}
