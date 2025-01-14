<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transfer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RekeningController;
use App\Models\Rekening;
use Illuminate\Support\Facades\Hash;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transfers = Transfer::all();
        return response()->json($transfers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_rekening' => 'required|string',
            'rekening_tujuan' => 'required|string',
            'jenis_transfer' => 'required|string',
            'pin' => 'required|string|min:6|max:6',
            'jumlah_transfer' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        $user = Auth::user();
        
        $rekening = Rekening::where('id_nasabah', $user->id_nasabah)->first();

        if (!Hash::check($validated['pin'], $rekening->pin)) {
            return redirect()->back()->withErrors(['pin' => 'Pin yang anda masukkan salah.']);
        }

        $rekeningTujuan = Rekening::where('nomor_rekening', $validated['rekening_tujuan'])->first();

        if (!$rekeningTujuan && $validated['jenis_transfer'] === 'AtmaBank') {
            return redirect()->back()->withErrors(['rekening_tujuan' => 'Rekening tujuan tidak ditemukan.']);
        }

        if($rekeningTujuan && $validated['jenis_transfer'] === 'AtmaBank') {
            $rekeningTujuan->saldo += $validated['jumlah_transfer'];
            $rekeningTujuan->save();
        }

        $adminFee = ($validated['jenis_transfer'] === 'AtmaBank') ? 2500 : 10000;

        $totalAmount = $validated['jumlah_transfer'] + $adminFee;

        if ($rekening->saldo < $totalAmount) {
            return redirect()->back()->withErrors(['balance' => 'Saldo tidak cukup untuk melakukan transfer.']);
        }

        $rekening->saldo -= $totalAmount;
        $rekening->save();

        $tanggal_transfer = now();

        $transfer = Transfer::create(array_merge($validated, ['tanggal_transfer' => $tanggal_transfer]));
       
        return redirect()->route('transfers.confirm', [
            'tanggal_transfer' => $tanggal_transfer,
            'no_transfer' => $transfer->no_transfer,
        ]);
    }

    public function confirm(Request $request)
    {
        // $adminFee = ($request['jenis_transfer'] === 'AtmaBank') ? 2500 : 10000;

        // $total = $request->input('jumlah_transfer') + $adminFee;

        // return redirect()->route('transaksi.details', [
        //     'jumlah_transfer' => $request->input('jumlah_transfer'),
        //     'rekening_tujuan' => $request->input('rekening_tujuan'),
        //     'no_transfer' => $request->input('no_transfer'),
        //     'tanggal_transfer' => $request->input('tanggal_transfer'),
        //     'adminFee' => $adminFee,
        //     'total' => $total,
        //     'nomor_rekening' => '******9827',
        // ]);

        $transfer = Transfer::where('no_transfer', $request->input('no_transfer'))->first();

        $tujuan = Rekening::join('users', 'rekenings.id_nasabah', '=', 'users.id_nasabah')
            ->select('users.nama_nasabah', 'rekenings.*')
            ->where('nomor_rekening', $transfer->rekening_tujuan)->first();
        
        return view('transaksi.transfers.confirm', compact('transfer', 'tujuan'));
    }

    public function details($id)
    {
        $transfer = Transfer::where('no_transfer', $id)->first();

        if (!$transfer) {
            return redirect()->back()->withErrors(['no_transfer' => 'Transfer tidak ditemukan.']);
        }

        if($transfer->jenis_transfer === 'AtmaBank') {
            $tujuan = Rekening::join('users', 'rekenings.id_nasabah', '=', 'users.id_nasabah')
                ->select('users.nama_nasabah', 'rekenings.*')
                ->where('nomor_rekening', $transfer->rekening_tujuan)->first();

            if (!$tujuan) {
                return redirect()->back()->withErrors(['error' => 'Rekening tujuan tidak ditemukan.']);
            }
        } else {
           $tujuan = [
               'nama_nasabah' => 'Other Bank',
               'nomor_rekening' => $transfer->rekening_tujuan,
           ];
        }

        
        return view('transaksi.transfers.details', compact('transfer', 'tujuan'));

        // return view('transaksi.transfers.details', [
        //     'tanggal_transfer' => $request->input('tanggal_transfer'),
        //     'no_transfer' => $request->input('no_transfer'),
        //     'rekening_tujuan' => $request->input('rekening_tujuan'),
        //     'jumlah_transfer' => $request->input('jumlah_transfer'),
        //     'adminFee' => $request->input('adminFee'),
        //     'total' => $request->input('total'),
        //     'nomor_rekening' => $request->input('nomor_rekening'),
        // ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transfer = Transfer::findOrFail($id);
        return response()->json($transfer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_rekening' => 'sometimes|string',
            'rekening_tujuan' => 'sometimes|string',
            'jenis_trasnfer' => 'sometimes|string',
            'jumlah_transfer' => 'sometimes|numeric',
            'tanggal_transfer' => 'sometimes|date',
        ]);

        $transfer = Transfer::findOrFail($id);
        $transfer->update($validated);
        return response()->json($transfer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transfer = Transfer::findOrFail($id);
        $transfer->delete();
        return response()->json(['message' => 'Transfer deleted successfully.']);
    }


    public function showTransferHistory()
    {
        $transfers = Transfer::leftJoin('rekenings', 'transfers.rekening_tujuan', '=', 'rekenings.nomor_rekening')
            ->leftJoin('users', 'rekenings.id_nasabah', '=', 'users.id_nasabah')
            ->select('transfers.*', \DB::raw('COALESCE(users.nama_nasabah, "Other Bank") as nama_tujuan'))
            ->where('transfers.nomor_rekening', Auth::user()->rekening->nomor_rekening)
            ->orderBy('no_transfer', 'desc')->get();

        return view('profiles.bankAcc.transferHistory', compact('transfers'));
    }
}