<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan : Agreement</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Boostrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('css/nav.css') }}">

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
            margin-bottom: 50px;
        }

        .foot {
            background: linear-gradient(90deg, #00FFCC 0%, #243465 100%);            
        }

        .container {
            margin-top: 50px;
        }

        .mb{
            margin-bottom:10px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }


        .btn-confirm{
            background: linear-gradient(to right, #00FFCC 0%, #13A7A8 100%);
            color: #2A407E;
            font-weight: bold;
            border: none;
            width: 50vw;
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
            color: white;
            opacity: 1;
        }

        .nav-link:hover,
        .nav-link:focus {
            color: #00FFCC;
        }

        .bold {
            font-weight: bold;
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-label {
            margin-left: 1rem; 
        }
    </style>
</head>
<body>
    <!-- Logout Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body pb-4">
                    <p class="text-end"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></p>
                    <h1 class="text-center fs-5" id="staticBackdropLabel">Are you sure want to log out?</h1>
                </div>
                <div class="modal-footer border-4 justify-content-center ">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn w-100 rounded-pill me-4 bold confirm" style="background-color: #00FFCC; color: #2A407E;">Logout</button>
                    </form>
                    <button type="button" class="btn w-25 rounded-pill bold" style="background-color: #FF7477; color: #2A407E;" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: transparent !important; z-index: 2;">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{url('/')}}"><img src="/img/Bank Logo.png" style="width: 70px;" alt="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item me-3">
                            <a class="nav-link" aria-current="page" href="{{url('home')}}">Home</a>
                        </li>
                        <li class="nav-item m-0 me-3 dropdown ">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Services
                            </a>
                            <ul class="dropdown-menu ">
                                <li><a class="dropdown-item " href="{{url('transaksi/transfer')}}">Transfer<i class="fa-solid fa-chevron-right ms-5"></i></a></li>
                                <li><a class="dropdown-item" href="{{url('transaksi/loan')}}">Loan &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-chevron-right ms-5"></i></a></li>
                            </ul>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{url('aboutUs')}}">About AtmaBank</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="#kontak">Contact</a>
                        </li>
                    </ul>
                    <div class="ms-auto" id="logbtn">
                        @if (Auth::check()) 
                            <div class="dropdown m-0">
                                <button class="btn dropdown-toggle pe-3 ps-3" type="button" id="dropdownMenuButton" 
                                    style="background-color: #1C6985; color: white;  border-radius: 20px;"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-regular fa-user pe-1"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="{{ route('profiles.profile') }}">Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ url('manageBankAcc') }}">Manage Bank Account</a></li>
                                    <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Logout</a></li>
                                </ul>
                            </div>
                        @else 
                            <a href="{{ route('login.show') }}" class="btn pe-3 ps-3"
                                style="background-color: #1C6985; color: white;  border-radius: 20px;">
                                <i class="fa-regular fa-user pe-1"></i> Log In
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        @if (session('success'))
            <div class="toast align-items-center text-bg-success border-0 ms-auto me-3" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </header>

    <main>
        <section>
            <div class="container">
                <h1 class="judul">Loan Agreement</h1>
            </div>

            
                <div class="container px-5">
                    <div class="box">
                        <form action=" {{ route('peminjaman.create') }} " method="POST">
                            @csrf
                        <div class="row p-4">
                            <p class="bold m-0">1. Loan Amount and Interest Rate</p>
                            <br>
                            <p>The Bank agrees to lend the Borrower the principal sum of [Loan Amount], with an interest rate of [Interest Rate]% per annum.</p>
                            <p class="bold m-0">2. Loan Term</p>
                            <br>
                            <p>The Loan is to be repaid over 3 years with monthly installments of amount each. </p>
                            <p class="bold m-0">3. Repayment Method</p>
                            <br>
                            <p>Payments will be automatically deducted from the Borrower's bank account on the due dates or made directly to the Bank's account.</p>
                            <p class="bold m-0">4. Late Payments and Fees</p>
                            <br>
                            <p>Late payments will incur a fee of IDR 1.000.000 after 7 days past the due date. Additional interest may accrue on overdue amounts.</p>
                            <p class="bold m-0">5. Prepayment</p>
                            <br>
                            <p>The Borrower can prepay the loan in full or part at any time without penalty, with early payments first applied to interest and then to the principal.</p>
                            <p class="bold m-0">6. Security</p>
                            <br>
                            <p>The Borrower agrees to provide the following collateral as security for the loan.</p>
                            <p class="bold m-0">7. Default</p>
                            <br>
                            <p>If the Borrower fails to make a payment, becomes bankrupt, or breaches this Agreement, the Bank may demand immediate repayment of the full loan amount, including any accrued interest and fees.</p>
                            <p class="bold m-0">8. Changes in Interest Rate</p>
                            <br>
                            <p>The Bank reserves the right to adjust the interest rate in accordance with market conditions, with prior notice to the Borrower, if this is a variable-rate loan.</p>
                            <p class="bold m-0">9. Governing Law</p>
                            <br>
                            <p>This Agreement is governed by the laws of Republic of Indonesia.</p>
                            <p class="bold m-0">10. Entire Agreement</p>
                            <br>
                            <p>This Agreement constitutes the entire understanding between the Bank and the Borrower.</p>
                        </div>

                        <div class="row p-4 m-1">
                            <div class="form-check d-flex align-items-start">
                                <input class="form-check-input" type="checkbox" id="exampleCheckbox" required>
                                <label class="form-check-label" for="exampleCheckbox">
                                    I authorize the Credit Union/Lending/Financing Company to obtain personal and credit information about me from my employers and credit bureaus, or credit reporting agencies, anyone with whom I have had or may have had financial dealings, or from any references I have provided. My information, as well as that which I provide in the application, will be collected in connection with this news and any other relationships that we may establish from time to time. Any personal and credit information obtained may be disclosed from time to time to other lenders, credit bureaus or other credit reporting agencies.
                                </label>
                            </div>

                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="exampleCheckbox2" required>
                                <label class="form-check-label" for="exampleCheckbox2">
                                    I agree that the information provided is true, accurate and complete as of the date of this application.
                                </label>
                            </div>
                        </div>

                        <div class="button-container">
                            <button class="btn-confirm rounded-pill" type="submit">Confirm</button>
                        </div>
                        </form>
                        <div class="button-container mt-4">
                            <a href="{{route('peminjaman.loan')}}">
                                <button class="btn-confirm rounded-pill">Back</button>
                            </a>
                        </div>
                    </div>
                
                </div>
           

            
        </section>

    </main>

    <div class="foot" id="kontak">
        <div class="container">
            <footer class="pt-4" >
                <div class="row">
                    <div class="col-4 col-md">
                        <h5 class="bold mb-4 mt-4">AtmaBank</h5>
                        <ul class="list-unstyled text-small">
                            <li><p class="m-0 mb-3 bold" style="color: #3B5266;">Contact us</p></li>
                            <li><p class="m-0 mb-2" >AtmaBank@gmail.com</p></li>
                            <li><p class="m-0 mb-2">+62-2345-6789</p></li>
                            <li><p class="m-0 mb-2" style="width: 16rem;">Jalan Tambakbayan No.88, Babarsari, Depok, Sleman</p> </li>
                        </ul>
                    </div>
                    <div class="col-4 col-md">
                        <ul class="ms-5 list-unstyled text-small">
                            <li><a href="{{url('aboutUs')}}" class="text-decoration-none"><p class="bold mb-0" style="color: #363940; margin-top: 70px;">About</p></a></li>
                            <li><a href="{{url(path: 'termsAndCondition')}}" class="text-decoration-none"><p class="bold mt-2" style="color: #363940;">Terms & Condition</p></a></li>
                            <li><p class="bold mt-4" style="color: #363940;">Follow Us</p></li>
                            <li>
                                <ul class="list-unstyled d-flex">
                                    <li><a class="link-dark" href="https://facebook.com"><i class="fa-brands fa-square-facebook fa-2x"></i></a></li>
                                    <li class="ms-3"><a class="link-dark" href="https://instagram.com"><i class="fa-brands fa-square-instagram fa-2x" ></i></a></li>
                                    <li class="ms-3"><a class="link-dark" href="https://x.com"><i class="fa-brands fa-square-x-twitter fa-2x"></i></a></li>
                                    <li class="ms-3"><a class="link-dark" href="https://linkedin.com"><i class="fa-brands fa-linkedin fa-2x"></i></a></li>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>
</html>