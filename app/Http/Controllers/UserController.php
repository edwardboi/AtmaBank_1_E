<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Exception;

class UserController extends Controller
{
    public function showRegisterStep1()
    {
        return view('account.register');
    }

    public function registerStep1(Request $request)
    {
        $rules = [
            'nama_nasabah' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|unique:pegawais',
            'alamat' => 'required|string|max:255',
            'nomor_telepon' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'password' => 'required|string|min:8|confirmed',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['error' => $firstError]);
        }
    
        $request->session()->put('register_step1', $request->except('password') + [
            'password' => Hash::make($request->password),
            'foto_profile' => 'gambarProfile/user.png', 
        ]);

        return redirect()->route('register.step2');
    }

    public function showRegisterStep2()
    {
        return view('account.register2');
    }

    public function registerStep2(Request $request)
    {
        $request->validate([
            'id_number' => 'required|string|min:16|max:16|unique:users',
            'foto_idnumber' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $step1Data = $request->session()->get('register_step1');

        if (!$step1Data) {
            return redirect()->route('register.step1')->with('error', 'Data pendaftaran langkah pertama tidak ditemukan!');
        }

        $foto_idnumber = $request->file('foto_idnumber');
        $imglocal = $foto_idnumber->move(public_path('FotoId'), $foto_idnumber->getClientOriginalName());
        $img = $foto_idnumber->getClientOriginalName();

        $nasabahData = array_merge($step1Data, [
            'id_number' => $request->id_number,
            'foto_idnumber' => $img,
        ]);

        $nasabah = User::create($nasabahData);

        $request->session()->forget('register_step1');

        return redirect()->route('login.show')->with('success', 'Berhasil register!');
    }

    public function showLogin()
    {
        return view('account.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        try {
            $admins = Pegawai::where('email', $request->email)->first();
            
            if (!$admins || $request->password !== $admins->password) {

                $nasabah = User::where('email', $request->email)->first();

                if (! $nasabah || ! Hash::check($request->password, $nasabah->password)) {
                    return redirect()->back()
                        ->withInput($request->only('email')) 
                        ->withErrors([
                            'password' => 'Email atau password salah.',
                        ]);
                }
        
                $token = $nasabah->createToken('Personal Access Token')->plainTextToken;

                session(['auth_token' => $token]);
        
                if(Auth::attempt($request->only('email', 'password'))){
                    Auth::guard('user')->login($nasabah);
                    return redirect()->route('home')->with('success', 'Welcome Nasabah!');
                }

            }else{
                Auth::guard('admin')->login($admins);
                $token = $admins->createToken('Admin Access Token')->plainTextToken;

                session(['auth_token' => $token]);
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
            }

        } catch(Exception $e){
            dd($e);
            return redirect()->back()->with('error', 'Gagal Login users.');
        }
    }

    public function logout(Request $request)
    {
        if ($request->user() && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();

            return response()->json(['message' => 'Logged out successfully'], 200);
        } else {
            if ($request->user()) {
                $request->user()->tokens()->delete();
            }
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Berhasil logout!');
    }

    public function update(Request $request)
    {   
        try {
            $validatedData = $request->validate([
                'nama_nasabah' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.Auth::user()->id_nasabah.',id_nasabah|unique:pegawais',
                'alamat' => 'required|string|max:255',
                'nomor_telepon' => 'required|string',
                'tanggal_lahir' => 'required|date',
                'foto_profile' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            
            $nasabahId = Auth::id();
    
            $nasabah = User::find($nasabahId);
    
            if (!$nasabah || $nasabah->id_nasabah != $nasabahId) {
                return redirect()->back()->with('error', 'Nasabah tidak ditemukan');
            }
    
            if($request->hasFile('foto_profile')){
                $image = $request->foto_profile;
                $imageName = $image->getClientOriginalName();

                if ($nasabah->foto_profile && $nasabah->foto_profile !== 'gambarProfile/user.png') {
                    $oldImagePath = public_path($nasabah->foto_profile);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $image->move(public_path('gambarProfile'), $imageName);
                
                $nasabah->update([
                    'nama_nasabah' => $validatedData['nama_nasabah'],
                    'email' => $validatedData['email'],
                    'alamat' => $validatedData['alamat'],
                    'nomor_telepon' => $validatedData['nomor_telepon'],
                    'tanggal_lahir' => $validatedData['tanggal_lahir'],
                    'foto_profile' => 'gambarProfile/' . $imageName,
                ]);

            }else{
                $nasabah->update([
                    'nama_nasabah' => $validatedData['nama_nasabah'],
                    'email' => $validatedData['email'],
                    'alamat' => $validatedData['alamat'],
                    'nomor_telepon' => $validatedData['nomor_telepon'],
                    'tanggal_lahir' => $validatedData['tanggal_lahir'],
                    'foto_profile' => Auth::user()->foto_profile,
                ]);
            }

            return redirect()->route('profiles.profile')->with('success', 'Berhasil mengupdate Nasabah');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate Nasabah');
        }
    }

    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $nasabahId = Auth::id();

        $nasabah = User::find($nasabahId);

        if (!$nasabah || $nasabah->id_nasabah != $nasabahId) {
            return response()->json(['message' => 'Nasabah tidak ditemukan'], 403);
        }

        if (!Hash::check($validatedData['old_password'], $nasabah->password)) {
            return redirect()->back()->with('error', 'Old Password is wrong!')->withErrors([
                'old_password' => 'Old Password is wrong!',
            ]);
        }

        if(Hash::check($validatedData['new_password'], $nasabah->password)){
            return redirect()->back()->with('error', 'New Password cannot be the same as Old Password!')->withErrors([
                'new_password' => 'New Password cannot be the same as Old Password!',
            ]);
        }

        $nasabah->update([
            'password' => Hash::make($validatedData['new_password']),
        ]);

        return redirect()->route('profiles.changedPassword')->with('success', 'Berhasil update password!');
    }   

}
