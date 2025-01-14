<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Condition</title>

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
            font-size: 80px;
        }

        .center {
            display: flex; 
            justify-content: center;
            align-items: center;
        }

        .trans {
            background-color: transparent;
            border: none;
        }

        .foot {
            background: linear-gradient(90deg, #00FFCC 0%, #243465 100%);            
        }

        .container {
            margin-top: 50px;
        }

        .profile-container {
            display: flex;
            justify-content: space-around;
            padding: 50px;
            margin: 0 auto;
            max-width: 1200px;
        }

        section p, section ul{
            color: white;
            margin: 0;
        }
        
        .nav-link:hover,
        .nav-link:focus {
            color: #00FFCC;
        }

        .bold {
            font-weight: bold;
        }    

    </style>
</head>
<body>
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
    </di>

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
            <div class="container mb-3">
                <h1 class="judul">Terms and Condition</h1>
            </div>
            <div class="container text-white">
                <ol>
                    <li>
                        <strong>Introduction</strong><br>
                        This document outlines the Terms and Conditions applicable to the money transfer and loan services provided by Atmabank, hereinafter referred to as the “Bank.” By using these services, the customer is deemed to have read, understood, and agreed to the Terms and Conditions herein.
                    </li>
                    <br>
                    <li>
                        <strong>Money Transfer Services</strong><br>
                        <strong>2.1. Definition</strong>
                        <p>The money transfer service includes sending funds from one account to another, both domestically and internationally, through the Bank's official website and mobile    banking application.</p>
                        <strong>2.2. Transfer Methods</strong>
                        <ul>
                            <li>Transfer via Website: Customers can transfer funds between banks through the Bank's official website after logging into their accounts with proper credentials.</li>
                            <li>Transfer via Mobile Banking: Customers can also transfer funds using the Bank's mobile banking application, available on Android and iOS devices.</li>
                        </ul>
                        <strong>2.3. Transfer Fees</strong>
                        <ul>
                            <li>Domestic Transfers: Fees for domestic bank transfers will be charged according to the prevailing rates.</li>
                            <li>International Transfers: Fees for international transfers will vary depending on the destination country and the amount transferred.</li>
                        </ul>
                        <strong>2.4. Limitation of Liability</strong>
                        <p>The Bank is not responsible for any delays or failures in transfers caused by factors beyond its control, such as network disruptions, incorrect data provided by the customer, or regulatory restrictions in the destination country.</p>
                    </li>
                    <br>
                    <li>
                        <strong>Loan Services</strong><br>
                        <strong>3.1. Loan Application</strong>
                        <p>Customers can apply for loans through the Bank's website or mobile application by filling out an application form and providing the required documents. Loans are available for terms of 1 month, 3 months, or 6 months.</p>
                        <strong>3.2. Loan Tenure</strong>
                        <ul>
                            <li>1-Month Loan: Short-term loan with repayment due within 1 month.</li>
                            <li>3-Month Loan: Loan with a 3-month repayment period.</li>
                            <li>6-Month Loan: Loan with a 6-month repayment period.</li>
                        </ul>
                        <strong>3.3. Interest Rate</strong>
                        <p>A fixed interest rate of 5% per annum will be applied to all loans, regardless of the loan term (1 month, 3 months, or 6 months). Interest will be calculated proportionally based on the loan duration.</p>
                        <strong>3.4. Repayment and Installments</strong>
                        <ul>
                            <li>Installment Payments: Monthly installment payments will include both principal and interest.</li>
                            <li>Payment Methods: Payments can be made via automatic transfer from the customer's Bank account, or through manual payments via the Bank's website or mobile application.</li>
                        </ul>
                        <strong>3.5. Late Payment Penalties</strong>
                        <p>Late payment penalties will apply if the customer fails to pay the installment after 7 days from the due date. The penalty amount will be 20% of the installment due.</p>
                        <strong>3.6. Default</strong>
                        <p>If the customer fails to make payments for 5 consecutive months, the Bank reserves the right to:</p>
                        <ul>
                            <li>Demand full payment of the outstanding loan balance (accelerated payment).</li>
                            <li>Take appropriate legal action.</li>
                        </ul>
                    </li>
                    <br>
                    <li>
                        <strong>Customer Responsibilities and Obligations</strong>
                        <ul>
                            <li>Customers must ensure that all information provided during loan applications or transfers is accurate and truthful.</li>
                            <li>Customers are responsible for maintaining the security of their accounts when accessing services through the website and mobile application.</li>
                        </ul>
                    </li>
                    <br>
                    <li>
                        <strong>Updates and Changes to Terms</strong>
                        <p>The Bank reserves the right to modify or update these Terms and Conditions at any time. Changes will be communicated to customers through available channels, such as email, SMS, or announcements at Bank branches and the official website.</p>
                    </li>
                    <br>
                    <li>
                        <strong>Governing Law</strong>
                        <p>These Terms and Conditions are governed by the laws of the Republic of Indonesia. Any disputes arising will be settled in the jurisdiction of the courts of Indonesia.</p>
                    </li>
                    <br>
                    <li>
                        <strong>Miscellaneous</strong>
                        <ul>
                            <li>Customers agree to comply with all policies and regulations set by the Bank regarding the use of services.</li>
                            <li>Any risks arising from the misuse of services will be the sole responsibility of the customer.</li>
                        </ul>
                    </li>
                </ol>
                <br>
                <p>AtmaBank</p>
                <p>Effective Date:  01 January 2025</p>
            </div>
            
        </section>

    <!-- Main Footer -->
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