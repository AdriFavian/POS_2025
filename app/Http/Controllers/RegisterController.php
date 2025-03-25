<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:m_user,username',
            'nama'     => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Registrasi tidak dapat diproses. Mohon periksa kembali data yang Anda masukkan.',
                'msgField' => $validator->errors()
            ]);
        }

        $user = UserModel::create([
            'level_id' => 3,
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        return response()->json([
            'status'   => true,
            'message'  => 'Akun Anda berhasil dibuat! welcome 😊.',
            'redirect' => url('/')
        ]);
    }
}
