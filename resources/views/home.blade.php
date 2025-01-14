<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Boostrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('css/home.css') }}">
    <link rel="stylesheet" href="{{asset('css/nav.css') }}">

    <style>
        .foot {
            background: linear-gradient(90deg, #00FFCC 0%, #243465 100%);            
        }

        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto;
            /* background-color: #2196F3;    */
            padding: 10px;
        }
        
        .grid-item {
            /* background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8); */
            text-align: start;
        }

        .item1 {
            /* align-self: flex-start; */
        }

        .item2 {
            /* align-self: flex-start; */
            grid-area: 2 / 1 / span 1 / span 1;
        }

        .item3 {
            grid-area: 1 / 2 / span 2 / span 2;
        }

        @media (max-width: 1000px) {
            .item2 {
                align-self: flex-start;
                grid-area: 3 / 1 / span 1 / span 1;
            }

            .item3 {
                /* padding: 30px; */
                grid-area: 2 / 1 / span 1 / span 1;
            }

            .profit {
                width: 23vw;
                height: 22vh;
            }

            .chart {
                width: 18vw;
                height: 16vh;
            }
        }


    </style>
</head>
<body>
    <section class="section-1" >

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
            <div class="grid-container" style="width: 80%; margin: 0 auto;">
                <div class="grid-item item1">
                    <h1 class="card-title mb-4 judul" style="font-size: 5.5vw;">Everything got way simpler</h1>
                </div>
                <div class="grid-item item2">
                    <p class="card-text text-white mt-4 mb-3">All in one for your savings and transaction online without
                                having to leave the house to make transactions.</p>
                    <a href="{{ route('manageBankAcc') }}" class="btn"
                        style="background-color: #00FFCC; color: white;  border-radius: 20px; padding: 10px 20px;">JOIN
                        NOW <i class="fa-solid fa-chevron-right"></i></a>
                </div>
                <div class="grid-item item3">
                    <img src="/img/cardHomePage1.png" class="w-100" alt="gmbr1">
                </div>
            </div>
    </section>

    <section class="section-2" style="padding-top: 30vh;">
        <div class="container center">
            <h5 class="mb-5 aqua" style="font-size: 5.5vw;">Get more profit with us</h5>
        </div>
        
        <div class="container center" style="width: 50vw">
            <div class="row row-cols-2 text-center g-2">
                <div class="col center">
                    <div class="card justify-content-center align-items-center trans" style="width: 15rem;">
                        <img src="/img/profit/mobile.png" class="card-img-top profit" alt="mobile1">
                        <div class="card-body">
                            <h5 class="card-title aqua bold">Free Transfer</h5>
                            <p class="card-text text-white">Up to 100x per month</p>
                        </div>
                    </div>
                </div>
                <div class="col center">
                    <div class="card justify-content-center align-items-center trans" style="width: 15rem;">
                        <img src="/img/profit/hand.png" class="card-img-top profit" alt="hand1">
                        <div class="card-body">
                            <h5 class="card-title aqua bold">Free Admins Fees</h5>
                            <p class="card-text text-white">No admin fees per month</p>
                        </div>
                    </div>
                </div>
                <div class="col center">
                    <div class="card justify-content-center align-items-center trans" style="width: 15rem;">
                        <img src="/img/profit/chart.png" class="card-img-top chart" alt="chart1">
                        <div class="card-body">
                            <h5 class="card-title aqua bold">Interest up to 5%</h5>
                            <p class="card-text text-white">Deposit Interest up to 6% p.a and Savings Interest 3.5% p.a</p>
                        </div>
                    </div>
                </div>
                <div class="col center">
                    <div class="card justify-content-center align-items-center trans" style="width: 18rem;">
                        <img src="/img/profit/redeem.png" class="card-img-top profit" alt="redeem1">
                        <div class="card-body">
                            <h5 class="card-title aqua bold">Interest is disbursed daily</h5>
                            <p class="card-text text-white">Savings interest is calculated and paid daily</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    
    <section class="section-3" id="sec-3" style="padding-top: 20vh; padding-bottom: 20vh;">
        <div class="container center d-inline text-center">
            <p class="mb-3 aqua bold" style="font-size: 35px; ">Most Popular</p>
            <p class="mb-5 aqua" style="font-size: 28px;">What are Our Sevices?</p>
        </div>
        <div class="container text-start" style="width: 75vw">
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2" >
                <div class="col center mb-2">
                    <div class="card p-3 servic border-0" style="width: 20rem; height: 25rem; border-radius: 18px;">
                        <div class="center">
                            <img src="/img/servic/transfer.png" class="card-img-top dompet" alt="transfer">
                        </div>
                        <div class="card-body text-start mt-3">
                            <h5 class="card-title text-white">Transfer</h5>
                            <p class="card-text text-white">Free transfer fee</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{url('transaksi/transfer')}}" class="btn btn-outline-light" style="border-radius: 15px;">
                               more <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col center mb-2">
                    <div class="card p-3 servic border-0" style="width: 20rem; height: 25rem; border-radius: 18px;">
                        <div class="center">
                            <img src="/img/servic/money_bag.png" class="card-img-top money pt-3" alt="money_bag">
                        </div>
                        <div class="card-body text-start mt-5">
                            <h5 class="card-title text-white">Loan</h5>
                            <p class="card-text text-white" style="font-size: 15px;">I'ts easier here</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{url('transaksi/loan')}}" class="btn btn-outline-light" style="border-radius: 15px;">
                               more <i class="fa-solid fa-arrow-right"></i>
                            </a> 
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
 
    <section class="section-4" style="padding-top: 5vh; padding-bottom: 20vh;">
        <div class="container center d-inline text-center">
            <p class="mb-3 bold text-white" style="font-size: 35px;">Our Feature</p>
            <p class="m-3 text-white" style="font-size: 28px;">Your Security is Our First Priority</p>
        </div>
        <div class="container" style="width: 80vw">
            <div class="row row-cols-1 row-cols-sm-2">
                <div class="col center">
                    <div class="card p-5 trans" style="width: 40rem; height: 25rem; border-radius: 18px;">
                        <div class="center">
                            <img src="/img/feature/fea1.png" class="card-img-top" alt="dompet">
                        </div>
                        <div class="card-body text-center mt-3">
                            <h5 class="card-title text-white">Two-Step Verification</h5>
                            <p class="card-text text-white">Access to your account information and transactions is protected by two-factor authentication.</p>
                        </div>
                    </div>
                </div>
                <div class="col center">
                    <div class="card p-5 trans" style="width: 40rem; height: 25rem; border-radius: 18px;">
                        <div class="center">
                            <img src="/img/feature/fea2.png" class="card-img-top" alt="transfer">
                        </div>
                        <div class="card-body text-center mt-3">
                            <h5 class="card-title text-white">Latest Encryption System</h5>
                            <p class="card-text text-white">AtmaBank will always protect your data and information with the latest encryption technology.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="testimonial-section" style="padding-top: 10vh; padding-bottom: 10vh;">
        <div class="container">
            <h3 class="text-center text-white">Get to Know Us</h3>
            <h2 class="text-center text-white mb-5">What's our customer says?</h2>

            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                                <div class="testimonial-card p-4 rounded text-center">
                                    <p class="testimonial-text">“AtmaBank sangat praktis dan sangat membantu dalam mengolah keuangan saya.”</p>
                                    <div class="profile mt-3">
                                        <div class="user-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="ms-3 text-start">
                                            <h6 class="mb-0">Edward Y</h6>
                                            <small>Founder KitaSantai</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                                <div class="testimonial-card p-4 rounded text-center">
                                    <p class="testimonial-text">“AtmaBank menjadi andalan saya dalam mengelola keuangan bisnis saya. Sangat praktis dan menguntungkan.”</p>
                                    <div class="profile mt-3">
                                        <div class="user-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="ms-3 text-start">
                                            <h6 class="mb-0">Catherine Co</h6>
                                            <small>Owner Mad For Money</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                                <div class="testimonial-card p-4 rounded text-center">
                                    <p class="testimonial-text">“Saya nyaman menggunakan AtmaBank karena fiturnya yang mudah dipakai. Keamanan yang mendukung membuat saya merasa tenang menabung di AtmaBank.”</p>
                                    <div class="profile mt-3">
                                        <div class="user-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="ms-3 text-start">
                                            <h6 class="mb-0">Tomy Lim</h6>
                                            <small>CEO Travelyuk</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                                <div class="testimonial-card p-4 rounded text-center">
                                    <p class="testimonial-text">“AtmaBank mempermudah pengelolaan keuangan pribadi saya dengan cepat dan aman.”</p>
                                    <div class="profile mt-3">
                                        <div class="user-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="ms-3 text-start">
                                            <h6 class="mb-0">James Chen</h6>
                                            <small>Freelancer</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                                <div class="testimonial-card p-4 rounded text-center">
                                    <p class="testimonial-text">“Saya sangat terbantu dengan fitur transaksi cepat AtmaBank, sangat efisien!”</p>
                                    <div class="profile mt-3">
                                        <div class="user-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="ms-3 text-start">
                                            <h6 class="mb-0">Rina Zhang</h6>
                                            <small>CEO of FastMove</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                                <div class="testimonial-card p-4 rounded text-center">
                                    <p class="testimonial-text">“AtmaBank memberikan layanan yang sangat ramah dan suportif bagi bisnis saya.”</p>
                                    <div class="profile mt-3">
                                        <div class="user-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="ms-3 text-start">
                                            <h6 class="mb-0">Alice Wong</h6>
                                            <small>Co-founder of GreatIdeas</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                                <div class="testimonial-card p-4 rounded text-center">
                                    <p class="testimonial-text">“AtmaBank mempermudah pengelolaan keuangan pribadi saya dengan cepat dan aman.”</p>
                                    <div class="profile mt-3">
                                        <div class="user-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="ms-3 text-start">
                                            <h6 class="mb-0">James Chen</h6>
                                            <small>Freelancer</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                                <div class="testimonial-card p-4 rounded text-center">
                                    <p class="testimonial-text">“Saya sangat terbantu dengan fitur transaksi cepat AtmaBank, sangat efisien!”</p>
                                    <div class="profile mt-3">
                                        <div class="user-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="ms-3 text-start">
                                            <h6 class="mb-0">Rina Zhang</h6>
                                            <small>CEO of FastMove</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                                <div class="testimonial-card p-4 rounded text-center">
                                    <p class="testimonial-text">“AtmaBank memberikan layanan yang sangat ramah dan suportif bagi bisnis saya.”</p>
                                    <div class="profile mt-3">
                                        <div class="user-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="ms-3 text-start">
                                            <h6 class="mb-0">Alice Wong</h6>
                                            <small>Co-founder of GreatIdeas</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Carousel controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <i class="fas fa-arrow-left text-white"></i>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <i class="fas fa-arrow-right text-white"></i>
                    <span class="visually-hidden">Next</span>
                </button>

                <!-- Carousel Indicators -->
                <div class="carousel-indicators" style="margin-top: 5vh;">
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
            </div>
        </div>
    </section>
    
        </main>

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
                            <li><p class="bold mt-2" style="color: #363940;">Terms & Condition</p></li>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastEl = document.querySelector('.toast');
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>