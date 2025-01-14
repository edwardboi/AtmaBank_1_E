<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pegawai;
use App\Models\Rekening;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RekeningController extends Controller
{
    public function index()
    {   
        $rekenings = Rekening::all();
        // return view('profiles.bankAcc.manage', compact('rekenings'));
    }

    public function show() {
        $rekening = Rekening::where('id_nasabah', Auth::id())->first();
        return view('profiles.bankAcc.manage', compact('rekening'));
    }

    public function create() { 
        return view('openBank.createAcc'); 
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'tipe_rekening' => 'required|string|in:Savings,Student',
                'income' => 'required|numeric',
                'pin' => 'required|string|min:6|max:6|confirmed',
                'tujuan' => 'required|string',
            ]);
    
    
            $nasabahId = Auth::id();
            $nasabah = User::find($nasabahId);
            if (!$nasabah || $nasabah->id_nasabah != $nasabahId) {
                return response()->json(['message' => 'Nasabah tidak ditemukan'], 403);
            }
            
            Rekening::create([
                'tipe_rekening' => $request->tipe_rekening,
                'income' => $request->income,
                'pin' => Hash::make($request->pin),
                'id_nasabah' => $nasabahId,
                'tujuan' => $request->tujuan,
                'saldo' => 0,
            ]);
    
            return redirect()->route('openBank.created')->with('success', 'Rekening berhasil dibuat!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()
                ->withInput($request->except('pin', 'pin_confirmation'))
                ->withErrors(['error' => $firstError]);
        }
        
    }

    public function update(Request $request, Rekening $rekening)
    {
        try {
            $request->validate([
                'tipe_rekening' => 'required|string|in:Savings,Student',
                'income' => 'required|numeric',
                'pin' => 'required|string|min:6|max:6|confirmed',
                'tujuan' => 'required|string',
            ]);
    
            $rekening->update([
                'tipe_rekening' => $request->tipe_rekening,
                'income' => $request->income,
                'pin' => Hash::make($request->pin),
                'tujuan' => $request->tujuan,
            ]);
    
            return redirect()->route('openBank.created')->with('success', 'Rekening berhasil diupdate!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()
                ->withInput($request->except('pin', 'pin_confirmation'))
                ->withErrors(['error' => $firstError]);
        }
    }


}
