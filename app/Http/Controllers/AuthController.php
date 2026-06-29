<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller {
    public function showLogin() {
        return view('auth.login');
    }
    public function showRegister() {
        return view('auth.register');
    }
    public function register(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'email.unique' => 'Email sudah terdaftar!',
            'password.min' => 'Password minimal 6 karakter!',
        ]);
        $lastNo = User::where('role','pasien')->whereNotNull('no_rm')->orderBy('id','desc')->first();
        $newNo = 'RM' . str_pad(($lastNo ? intval(substr($lastNo->no_rm,2)) + 1 : 1), 5, '0', STR_PAD_LEFT);
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'role' => 'pasien',
            'no_rm' => $newNo,
        ]);
        return redirect('/login')->with('success', 'Registrasi berhasil! No. RM: '.$newNo.'. Silakan login.');
    }
    public function login(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect('/');
        }
        return back()->with('error', 'Email atau password salah!');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
