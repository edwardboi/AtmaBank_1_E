<?php

use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RekeningController;
use App\Http\Middleware\CheckBankAccount;
use App\Models\Peminjaman;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/register', [UserController::class, 'showRegisterStep1'])->name('register.step1');
Route::post('/register', [UserController::class, 'registerStep1'])->name('register.step1.submit');

Route::get('/register2', [UserController::class, 'showRegisterStep2'])->name('register.step2');
Route::post('/register2', [UserController::class, 'registerStep2'])->name('register.step2.submit');

Route::get('/login', [UserController::class, 'showLogin'])->name('login.show');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/forgot', function () {
    return view('account.forgot');
});

Route::get('/sidescreen', function () {
    return view('sidescreen');
});

Route::get('/aboutUs', function () {
    return view('penjelasan.about');
});

Route::get('/termsAndCondition', function () {
    return view('penjelasan.term');
});

Route::get('/privacyPolicy', function () {
    return view('penjelasan.privacy');
});

//buat user
Route::middleware('auth')->group(function () {
    Route::get('/profiles/profile', function () {
        return view('profiles.profile');
    })->name('profiles.profile');

    Route::get('/profiles/editProfile', function () {
        return view('profiles.editProfile');
    })->name('profiles.editProfile');

    Route::post('/profiles/editProfile', [UserController::class, 'update'])->name('profiles.update');

    Route::get('/profiles/password', function () {
        return view('profiles.password');
    })->name('profiles.password');

    Route::post('/profiles/password', [UserController::class, 'changePassword'])->name('profiles.updatePassword');

    Route::get('/profiles/changedPassword', function () {
        return view('profiles.changedPassword');
    })->name('profiles.changedPassword');

    Route::get('/manageBankAcc', [RekeningController::class, 'show'])
        ->name('manageBankAcc')
        ->middleware('auth', CheckBankAccount::class);

    Route::get('/openBank/createAcc', [RekeningController::class, 'create'])->name('openBank.createAcc');
    Route::post('/openBank/createAcc', [RekeningController::class, 'store'])->name('openBank.store');

    Route::get('/openBank/created', function () {
        return view('openBank.created');
    })->name('openBank.created');

    Route::post('/transfers', [TransferController::class, 'store'])
        ->name('transfers.store')
        ->middleware('auth', CheckBankAccount::class);

    Route::get('/transfers/confirm', [TransferController::class, 'confirm'])
        ->name('transfers.confirm')
        ->middleware('auth', CheckBankAccount::class);
    
    Route::get('/transaksi/transfer', function () {
        $user = Auth::user();
        return view('transaksi.transfers.transfer', compact('user'));
    })->middleware('auth', CheckBankAccount::class);

    Route::get('/transfer/details/{id}', [TransferController::class, 'details'])
        ->name('transaksi.details')
        ->middleware('auth', CheckBankAccount::class);

    Route::get('/transferHistory', [TransferController::class, 'showTransferHistory'])
        ->name('transferHistory')
        ->middleware('auth', CheckBankAccount::class);

    Route::get('/loanHistory', [PeminjamanController::class, 'showLoanHistory'])
        ->name('loanHistory')
        ->middleware('auth', CheckBankAccount::class);

    Route::get('/transaksi/loan', function () {
        $lastLoan = Peminjaman::orderBy('no_peminjaman', 'desc')->first();
        return view('transaksi.peminjaman.loan', compact('lastLoan'));
    })->name('peminjaman.loan')->middleware('auth', CheckBankAccount::class);
    
    Route::post('/transaksi/agreement', [PeminjamanController::class, 'store'])
        ->name('peminjaman.agree')
        ->middleware('auth', CheckBankAccount::class);
    
    Route::post('/transaksi/loanCreate', [PeminjamanController::class, 'store2'])
        ->name('peminjaman.create')
        ->middleware('auth', CheckBankAccount::class);
    
    Route::get('/transaksi/confirmLoan', function () {
        return view('transaksi.peminjaman.confirmLoan');
    })->name('peminjaman.confirm')->middleware('auth', CheckBankAccount::class);;
    
    Route::get('/loan/details/{no_peminjaman}', [PeminjamanController::class, 'showById'])
        ->name('peminjaman.loanDetail')
        ->middleware('auth', CheckBankAccount::class);

});


//buat admin
Route::middleware('auth:admin')->group(function () {

    Route::get('/admin', [PegawaiController::class, 'adminDashboard'])->name('admin.dashboard');

    Route::post('/logoutAdmin', [PegawaiController::class, 'logoutAdmin'])->name('logout.admin');

    Route::get('/admin/userList', [PegawaiController::class, 'showUserList'])->name('admin.userList');

    Route::get('/admin/userDetail/{id}', [PegawaiController::class, 'showUserDetail'])->name('admin.userDetail');

    Route::get('/admin/userDelete/{id}', [PegawaiController::class, 'destroyUser'])->name('admin.userDelete');

    Route::get('admin/userEdit/{id}', [PegawaiController::class, 'showEditUser'])->name('admin.showUserEdit');

    Route::post('admin/userEdit/{id}', [PegawaiController::class, 'editUser'])->name('admin.editUser');

    Route::get('/admin/loanList', [PegawaiController::class, 'showLoanList'])->name('admin.loanList');
  
    Route::get('/admin/loanDetail/{id}', [PegawaiController::class, 'showLoanDetail'])->name('admin.loanDetail');

    Route::get('/admin/acceptLoan/{id}', [PegawaiController::class, 'acceptLoan'])->name('admin.acceptLoan');

    Route::get('/admin/rejectLoan/{id}', [PegawaiController::class, 'rejectLoan'])->name('admin.rejectLoan');

    Route::get('/admin/rekeningList', [PegawaiController::class, 'showRekeningList'])->name('admin.rekeningList');

    Route::get('/admin/rekeningDelete/{id}', [PegawaiController::class, 'destroyRekening'])->name('admin.rekeningDelete');

    Route::get('/admin/rekeningDetail/{id}', [PegawaiController::class, 'showRekeningDetail'])->name('admin.rekeningDetail');

    Route::get('/admin/transferList', [PegawaiController::class, 'showTransferList'])->name('admin.transferList');
    
    Route::get('/admin/transferDetail/{id}', [PegawaiController::class, 'showTransferDetail'])->name('admin.transferDetail');  

    Route::post('/admin/transferDelete/{id}', [PegawaiController::class, 'deleteTransfer'])->name('admin.transferDelete');
    
});