<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Rekening;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class PeminjamanController extends Controller
{
    public function index() {
        $peminjamans = Peminjaman::orderBy('created_at', 'desc')->paginate(10);
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function show($no_rekening) {
        $peminjamans = Peminjaman::where('nomor_rekening', $no_rekening)->get();

        if ($peminjamans->isEmpty()) {
            return redirect()->route('peminjaman.index')->with('warning', 'Data peminjaman tidak ditemukan.');
        }

        return view('peminjaman.show', ['peminjamans' => $peminjamans]);
    }

    public function showById($no_peminjaman) {
        $peminjamans = Peminjaman::where('no_peminjaman', $no_peminjaman)->first();
        
        if(!$peminjamans) {
            return redirect()->route('peminjaman.index')->with('warning', 'Data peminjaman tidak ditemukan.');
        }

        return view('transaksi.peminjaman.loanDetail', ['peminjamans' => $peminjamans]);
    }

    public function store(Request $request) {
        try {
            $validated = $request->validate([
                'suku_bunga' => 'nullable',
                'periode_peminjaman' => 'required',
                'jumlah_peminjaman' => 'required',
                'nomor_rekening' => 'nullable',
                // 'id_pegawai' => 'required|exists:pegawais,id',
            ]);

            $rekening = Rekening::where('id_nasabah', Auth::id())->first();

            $validated['nomor_rekening'] = $rekening->nomor_rekening;

            $validated['periode_peminjaman'] = (int)$validated['periode_peminjaman'];

            if($validated['periode_peminjaman'] == 1){
                $validated['suku_bunga'] = 5.0;
            } else if($validated['periode_peminjaman'] == 3) {
                $validated['suku_bunga'] = 4.0;
            } else if($validated['periode_peminjaman'] == 6) {
                $validated['suku_bunga'] = 3.0;
            }
            

            $validated['status_peminjaman'] = "Waiting";
            $validated['tanggal_peminjaman'] = Carbon::now();
            $validated['tanggal_pelunasan'] = Carbon::now()->addMonths($validated['periode_peminjaman'])->toDateTimeString();

            
            $request->session()->put('peminjamanTemp', $validated);
            // Peminjaman::create($validated);
            
            return view('transaksi.peminjaman.agreement');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Validasi data gagal. Silakan periksa kembali input Anda.');
        }
    }

    public function store2(Request $request) {
        $store1Data = $request->session()->get('peminjamanTemp');
        $loan = Peminjaman::create($store1Data);

        $request->session()->forget('peminjamanTemp');

        return redirect()->route('peminjaman.confirm')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $no_peminjaman) {
        try {
            $peminjaman = Peminjaman::findOrFail($no_peminjaman);

            $validated = $request->validate([
                'suku_bunga' => 'sometimes|numeric',
                'periode_peminjaman' => 'sometimes|integer',
                'status_peminjaman' => 'sometimes|string',
                'jumlah_peminjaman' => 'sometimes|numeric',
                'tanggal_peminjaman' => 'sometimes|date',
                'nomor_rekening' => 'sometimes|string',
                'id_pegawai' => 'sometimes|integer',
            ]);

            if (isset($validated['tanggal_peminjaman']) || isset($validated['periode_peminjaman'])) {
                $tanggalPinjam = isset($validated['tanggal_peminjaman']) 
                    ? Carbon::parse($validated['tanggal_peminjaman']) 
                    : Carbon::parse($peminjaman->tanggal_peminjaman);

                $periode = isset($validated['periode_peminjaman']) 
                    ? (int) $validated['periode_peminjaman'] 
                    : (int) $peminjaman->periode_peminjaman;

                $validated['tanggal_pelunasan'] = $tanggalPinjam->addMonths($periode);
            }

            $peminjaman->update($validated);

            return response()->json($peminjaman, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat memperbarui data'], 500);
        }
    }

    public function destroy($no_peminjaman) {
        try {
            $peminjaman = Peminjaman::findOrFail($no_peminjaman);
            $peminjaman->delete();

            return response()->json(['message' => 'Peminjaman berhasil dihapus'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Peminjaman tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus peminjaman'], 500);
        }
    }

    public function showLoanHistory() {
        $loanHistories = Peminjaman::where('nomor_rekening', Auth::user()->rekening->nomor_rekening)
            ->orderBy('no_peminjaman', 'desc')->get();

        return view('profiles.bankAcc.loanHistory', compact('loanHistories'));
    }
}
