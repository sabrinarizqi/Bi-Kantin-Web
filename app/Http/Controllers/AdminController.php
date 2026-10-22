<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Menu;
use App\Models\Pesanan;

class AdminController extends Controller
{
    public function authenticate(Request $request)
    {
        $user = User::where('username', $request->username)
                    ->where('password', $request->password)
                    ->first();

        if ($user) {
            session(['user_id' => $user->id, 'role' => $user->role]);

            if ($user->role === 'admin_kantin' || $user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('siswa.dashboard');
            }
        }

        return redirect()->back()->with('error', 'Username atau password salah!');
    }

    public function dashboard()
    {
        $menus = Menu::all();
        $pesanans = Pesanan::all();
        return view('admin.dashboard', compact('menus', 'pesanans'));
    }

    public function storeMenu(Request $request)
    {
        Menu::create([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function updateStatusPesanan(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status pesanan diperbarui!');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}