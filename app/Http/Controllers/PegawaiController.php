<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Rekening;
use App\Models\Transfer;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function logoutAdmin(Request $request)
    {
        try {
            $admins = Auth::guard('admin')->user();
            if ($admins) {
                if (method_exists($admins, 'currentAccessToken') && $admins->currentAccessToken()) {
                    $admins->currentAccessToken()->delete();
                }

                if (method_exists($admins, 'tokens')) {
                    $admins->tokens()->delete();
                }
            }

            Auth::guard('admin')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('home')->with('success', 'Berhasil logout admins.');
        }catch(Exception $e){
            
            return redirect()->back()->with('error', 'Gagal Logout admins.');
        }
    }

    public function adminDashboard()
    {
        $users = User::all();
        $rekenings = Rekening::all();
        $transfers = Transfer::all();
        $peminjamans = Peminjaman::all();

        $transferTable = Transfer::join('rekenings as rek_asal', 'transfers.nomor_rekening', '=', 'rek_asal.nomor_rekening')
            ->join('users as user_asal', 'rek_asal.id_nasabah', '=', 'user_asal.id_nasabah')
            ->leftJoin('rekenings as rek_tujuan', 'transfers.rekening_tujuan', '=', 'rek_tujuan.nomor_rekening')
            ->leftJoin('users as user_tujuan', 'rek_tujuan.id_nasabah', '=', 'user_tujuan.id_nasabah')
            ->select('transfers.*', 'user_asal.nama_nasabah as asal_user', 
            \DB::raw('IFNULL(user_tujuan.nama_nasabah, "Other Bank") as tujuan_user'))
            ->orderBy('no_transfer', 'desc')->paginate(10);

        $loanTable = Peminjaman::join('rekenings', 'peminjamans.nomor_rekening', '=', 'rekenings.nomor_rekening')
            ->join('users', 'rekenings.id_nasabah', '=', 'users.id_nasabah')
            ->select('peminjamans.*', 'users.nama_nasabah')
            ->orderBy('no_peminjaman', 'desc')->paginate(10);

        return view('admin.dashboardAdmin', compact('users', 'rekenings', 'transfers', 'peminjamans', 'transferTable', 'loanTable'));
    }

    public function showUserList()
    {
        $users = User::orderBy('id_nasabah', 'desc')->get();
        return view('admin.userList', compact('users'));
    }

    public function showUserDetail($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
        return view('admin.admUsrDetail', compact('user'));
    }

    public function destroyUser($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return redirect()->back()->with('error', 'User tidak ditemukan.');
            }   

            $user->delete();
            return redirect()->route('admin.userList')->with('success', 'Berhasil menghapus user.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus user.');
        }
    }

    public function showEditUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
        return view('admin.admUsrEdit', compact('user'));
    }

    public function editUser(Request $request, $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return redirect()->back()->with('error', 'User tidak ditemukan.');
            }

            $validatedData = $request->validate([
                'nama_nasabah' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id_nasabah . ',id_nasabah|unique:pegawais',
                'alamat' => 'required|string|max:255',
                'nomor_telepon' => 'required|string',
                'tanggal_lahir' => 'required|date',
            ]);

            $user->update([
                'nama_nasabah' => $validatedData['nama_nasabah'],
                'email' => $validatedData['email'],
                'alamat' => $validatedData['alamat'],
                'nomor_telepon' => $validatedData['nomor_telepon'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
            ]);

            return redirect()->route('admin.userDetail', ['id' => $user->id_nasabah])->with('success', 'Berhasil mengedit user.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengedit user.');
        }
    }

    public function showRekeningList()
    {
        $rekenings = Rekening::orderBy('nomor_rekening', 'desc')->get();

        return view('admin.rekeningList', compact('rekenings'));
    }

    public function showRekeningDetail($id)
    {
        try {
            $rekening = Rekening::join('users', 'rekenings.id_nasabah', 'users.id_nasabah')
                ->select('rekenings.*', 'users.nama_nasabah')
                ->where('rekenings.nomor_rekening', $id)->first();

            if(!$rekening){
                return redirect()->back()->with('error', 'Rekening tidak ditemukan.');
            }

            return view('admin.admRekDetail', compact('rekening'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menampilkan detail rekening.');
        }
    }

    public function destroyRekening($nomor_rekening)
    {
        try {
            $rekening = Rekening::find($nomor_rekening);
            if (!$rekening) {
                return redirect()->back()->with('error', 'Rekening tidak ditemukan.');
            }
            $rekening->delete();
            return redirect()->route('admin.rekeningList')->with('success', 'Berhasil menghapus rekening.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus rekening.');
        }
    }
    
    public function showTransferList(){
        $transfers = Transfer::join('rekenings', 'transfers.nomor_rekening', '=', 'rekenings.nomor_rekening')
            ->join('users', 'rekenings.id_nasabah', '=', 'users.id_nasabah')
            ->select('transfers.*', 'users.nama_nasabah')
            ->orderBy('no_transfer', 'desc')->get();
        
        return view('admin.transferList', compact('transfers'));
    }

    public function showTransferDetail($id){
        $transfer = Transfer::join('rekenings', 'transfers.nomor_rekening', '=', 'rekenings.nomor_rekening')
            ->select('transfers.*', 'rekenings.saldo')
            ->where('no_transfer', $id)->first();

        if(!$transfer){
            return redirect()->back()->with('error', 'Transfer tidak ditemukan.');
        }

        return view('admin.admTfDetail', compact('transfer'));
    }

    public function deleteTransfer($id) {
        try{
            $transfer = Transfer::where('no_transfer', $id)->first();
            if(!$transfer){
                return redirect()->back()->with('error', 'Transfer tidak ditemukan.');
            }
            $transfer->delete();
            return redirect()->route('admin.transferList')->with('success', 'Berhasil menghapus transfer.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Gagal menghapus transfer.');
        }
    }

    public function showLoanList() {
        $peminjamans = Peminjaman::join('rekenings', 'peminjamans.nomor_rekening', '=', 'rekenings.nomor_rekening')
            ->join('users', 'rekenings.id_nasabah', '=', 'users.id_nasabah')
            ->select('peminjamans.*', 'users.nama_nasabah')
            ->orderBy('no_peminjaman', 'desc')->get();
        
        return view('admin.loanList', compact('peminjamans'));
    }

    public function showLoanDetail($id) {
        $peminjaman = Peminjaman::join('rekenings', 'peminjamans.nomor_rekening', '=', 'rekenings.nomor_rekening')
            ->join('users', 'rekenings.id_nasabah', '=', 'users.id_nasabah')
            ->select('peminjamans.*', 'users.nama_nasabah', 'rekenings.saldo')
            ->where('no_peminjaman', $id)->first();
        
        if(!$peminjaman){
            return redirect()->back()->with('error', 'Peminjaman tidak ditemukan.');
        }

        return view('admin.admLoanDetail', compact('peminjaman'));
    }

    public function acceptLoan($id) {
        try{
            $peminjaman = Peminjaman::where('no_peminjaman', $id)->first();
            if(!$peminjaman){
                return redirect()->back()->with('error', 'Peminjaman tidak ditemukan.');
            }

            $rekening = Rekening::where('nomor_rekening', $peminjaman->nomor_rekening)->first();

            if(!$rekening){
                return redirect()->back()->with('error', 'Rekening tidak ditemukan.');
            }

            $peminjaman->update([
                'status_peminjaman' => 'Approved',
                'id_pegawai' => Auth::guard('admin')->user()->id_pegawai,
            ]);

            $rekening->update(['saldo' => $rekening->saldo + $peminjaman->jumlah_peminjaman]);

            return redirect()->route('admin.loanList')->with('success', 'Berhasil menerima peminjaman.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Gagal menerima peminjaman.');
        }
    }

    public function rejectLoan($id) {
        try{
            $peminjaman = Peminjaman::where('no_peminjaman', $id)->first();
            if(!$peminjaman){
                return redirect()->back()->with('error', 'Peminjaman tidak ditemukan.');
            }

            $peminjaman->update([
                'status_peminjaman' => 'Rejected',
                'id_pegawai' => Auth::guard('admin')->user()->id_pegawai
            ]);

            return redirect()->route('admin.loanList')->with('success', 'Berhasil menolak peminjaman.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Gagal menolak peminjaman.');
        }
    }

}
