<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin : Loan Details</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Boostrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            transition: background-color 0.5s ease;
            background: linear-gradient(-70deg, #13A7A8 0%, #2A407E 57%, #151931 100%);
        }

        .nav-link {
            color: white;
            font-weight: bold;
        }

        .judul {
            background: -webkit-linear-gradient(360deg, #00FFCC 0%, #00997A 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 65px;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            background: linear-gradient(330deg, #00FFCC -100%, #243465 85%);
            padding: 40px;
            border-radius: 20px;
            color: white;
            width: 70vw;
            margin: 0 auto;
        }

        .foot {
            background: linear-gradient(90deg, #00FFCC 0%, #243465 100%);
        }

        .container {
            margin-top: 50px;
        }

        .mb {
            margin-bottom: 10px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }


        .btn-confirm {
            background: linear-gradient(to right, #00FFCC 0%, #13A7A8 100%);
            color: #2A407E;
            font-weight: bold;
            border: none;
            width: 25vw;
            padding: 10px;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn-confirm:hover {
            background: linear-gradient(to left, #00FFCC 0%, #13A7A8 100%);
        }

        .balance {
            background: #243465;
            opacity: 45%;
            color: white;
            border: none;
            outline: none;
        }

        .balance::placeholder {
            color: #13A7A8;
            opacity: 1;
        }

        .nav-link:hover,
        .nav-link:focus {
            color: #00FFCC;
        }

        .bold {
            font-weight: bold;
        }

        .password-toggle {
            cursor: pointer;
            font-size: 18px;
        }

        .password-toggle i {
            color: #6c757d;
        }

        .input-group-text {
            border: none;
        }
    </style>
</head>

<body>
    <!-- Logout Modal -->
    <div class="modal fade" id="staticlogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body pb-4">
                    <p class="text-end"><button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button></p>
                    <h1 class="text-center fs-5" id="staticBackdropLabel">Are you sure want to log out?</h1>
                </div>
                <div class="modal-footer border-4 justify-content-center ">
                    <form action="{{ route('logout.admin') }}" method="POST" class="w-25 me-4 ">
                        @csrf
                        <button type="submit" class="btn w-100 rounded-pill bold"
                            style="background-color: #00FFCC; color: #2A407E;">
                            Yes
                        </button>
                    </form>
                    <button type="button" class="btn w-25 rounded-pill bold"
                        style="background-color: #FF7477; color: #2A407E;" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary"
            style="background-color: transparent !important; z-index: 2;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="/img/Bank Logo.png" style="width: 70px;"
                        alt="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ url('admin') }}">Dashboard</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ url('admin/userList') }}">Users</a>
                        </li>
                        <li class="nav-item m-0 me-3 ">
                            <a class="nav-link" href="{{ url('admin/transferList') }}">Transfer</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" aria-current="page" href="{{ url('admin/loanList') }}"
                                style="color: #00FFCC;">Loan</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ url('admin/rekeningList') }}">Account</a>
                        </li>
                    </ul>
                    <div class="me-4 ms-auto" id="logbtn">
                        <a href="" class="btn pe-3 ps-3" data-bs-toggle="modal" data-bs-target="#staticlogout"
                            style="background-color: #243465; color: white;  border-radius: 20px;">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section>
            <div class="container">
                <h1 class="judul">Loan</h1>
            </div>

            <div class="container px-5">
                <div class="box">
                    <div class="row p-4">
                        <div class="col-md-4 col mb-3 mt-2">
                            <p>Name</p>
                        </div>

                        <div class="col-md-8 col-12 mb-4">
                            <input type="text" class="form-control form-control-lg" id="akun"
                                placeholder="{{$peminjaman->nama_nasabah}}" disabled>
                        </div>

                        <div class="col-md-4 col mb-3 mt-2">
                            <p>Account Number</p>

                        </div>

                        <div class="col-md-8 col-12 mb-4">
                            <input type="text" class="form-control form-control-lg" id="akun"
                                placeholder="{{$peminjaman->nomor_rekening}}" disabled>
                        </div>

                        <div class="col-md-4 col mb-3 mt-2">
                            <p>Balance Amount</p>
                        </div>

                        <div class="col-md-8 col-12 mb-4">
                            <div class="input-group">
                                <input type="password" class="form-control form-control-lg w-75" id="balance"
                                    value="{{ number_format($peminjaman->saldo, 0, ',', '.') }}" disabled />
                                <span class="input-group-text password-toggle" onclick="togglePassword('balance')">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4 col mb-3 mt-2 mt-4">
                            <p>Date</p>
                        </div>

                        <div class="col-md-8 col-12 mb-4 mt-4">
                            <input type="text" class="form-control form-control-lg" id="balance"
                                value="{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d/m/Y') }}" disabled>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container px-5">
                <div class="box">
                    <div class="row p-4">
                        <div class="col-md-4 col mb-3 mt-2">
                            <p>Loan Number</p>
                        </div>

                        <div class="col-md-8 col-12 mb-4">
                            <input type="password" class="form-control form-control-lg balance" id="loanNumber"
                                placeholder="{{$peminjaman->no_peminjaman}}" readonly>
                        </div>

                        <div class="col-md-4 col mb-3 mt-2">
                            <p>Interest rate</p>
                        </div>

                        <div class="col-md-8 col-12 mb-4">
                            <input type="password" class="form-control form-control-lg balance" id="interest"
                                placeholder="{{$peminjaman->suku_bunga}}%" readonly>
                        </div>

                        <div class="col-md-4 col mb-3">
                            <p>Loan period</p>
                        </div>

                        <div class="col-md-8 col-12 mb-4">
                            <input type="text" id="loanPeriod" class="form-control form-control-lg mb-2" placeholder="{{$peminjaman->periode_peminjaman}} months" disabled />
                        </div>

                        <div class="col-md-4 col mb-3">
                            <p>Amount</p>
                        </div>

                        <div class="col-md-8 col-12 mb-4">
                            <div class="d-flex align-items-center">
                                <span class="me-2">IDR</span>
                                <input type="text" class="form-control form-control-lg" id="amount"
                                    value="{{number_format($peminjaman->jumlah_peminjaman, 0, ',', '.')}}" disabled />
                            </div>
                        </div>
                    </div>

                    @if ($peminjaman->status_peminjaman === "Waiting")
                        <div class="col-md-6 col-12 d-flex justify-content-center" style="margin: 0 auto;">
                            <div class="button-container me-5">
                                <a href="{{ route('admin.acceptLoan', ['id' => $peminjaman->no_peminjaman]) }}">
                                    <button class="btn-confirm rounded-pill">Accept</button>
                                </a>
                            </div>
                            <div class="button-container ms-3">
                                <a href="{{ route('admin.rejectLoan', ['id' => $peminjaman->no_peminjaman]) }}">
                                    <button class="btn-confirm rounded-pill">Deny</button>
                                </a>
                            </div>
                        </div>
                    @endif
                    
                </div>
            </div>

        </section>

    </main>

    <div class="foot" id="kontak">
        <div class="container">
            <footer class="pt-4">
                <div class="row">
                    <div class="col-4 col-md">
                        <h5 class="bold mb-4 mt-4">AtmaBank</h5>
                        <ul class="list-unstyled text-small">
                            <li>
                                <p class="m-0 mb-3 bold" style="color: #3B5266;">Contact us</p>
                            </li>
                            <li>
                                <p class="m-0 mb-2">AtmaBank@gmail.com</p>
                            </li>
                            <li>
                                <p class="m-0 mb-2">+62-2345-6789</p>
                            </li>
                            <li>
                                <p class="m-0 mb-2" style="width: 16rem;">Jalan Tambakbayan No.88, Babarsari, Depok,
                                    Sleman</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-4 col-md">
                        <ul class="ms-5 list-unstyled text-small">
                            <li><a href="{{ url('aboutUs') }}" class="text-decoration-none">
                                    <p class="bold mb-0" style="color: #363940; margin-top: 70px;">About</p>
                                </a></li>
                            <li><a href="{{ url(path: 'termsAndCondition') }}" class="text-decoration-none">
                                    <p class="bold mt-2" style="color: #363940;">Terms & Condition</p>
                                </a></li>
                            <li>
                                <p class="bold mt-4" style="color: #363940;">Follow Us</p>
                            </li>
                            <li>
                                <ul class="list-unstyled d-flex">
                                    <li><a class="link-dark" href="https://facebook.com"><i
                                                class="fa-brands fa-square-facebook fa-2x"></i></a></li>
                                    <li class="ms-3"><a class="link-dark" href="https://instagram.com"><i
                                                class="fa-brands fa-square-instagram fa-2x"></i></a></li>
                                    <li class="ms-3"><a class="link-dark" href="https://x.com"><i
                                                class="fa-brands fa-square-x-twitter fa-2x"></i></a></li>
                                    <li class="ms-3"><a class="link-dark" href="https://linkedin.com"><i
                                                class="fa-brands fa-linkedin fa-2x"></i></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h5 class="mt-5 text-center text-white bold">Get In Touch</h5>
                        <h2 class="text-center text-white bold">Join Our Newsletter</p>
                            <form class="d-flex mt-5">
                                <input type="email" class="form-control" placeholder="Your email">
                                <button type="submit" class="btn btn-dark ms-4 rounded-pill">Subscribe</button>
                            </form>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <p class="text-black pb-3 m-0">Copyright © 2024. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </div>


    <script>
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            const icon = input.nextElementSibling.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>

</html>
