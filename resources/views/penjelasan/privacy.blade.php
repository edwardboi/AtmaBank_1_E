<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>

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
            <div class="container mb-3">
                <h1 class="judul">Privacy Policy</h1>
            </div>
            <div class="container text-white">
                <ol>
                    <li>
                        <strong>Introduction</strong><br>
                        At BankName (hereinafter referred to as the "Bank"), we are committed to safeguarding the privacy and confidentiality of our customers' personal data. This Privacy Policy outlines how we collect, use, disclose, and protect information when you use our money transfer and loan services through our website and mobile application.
                    </li>
                    <br>
                    <li>
                        <strong>Data Collection</strong><br>
                        <p>We collect personal data necessary for providing our services, including but not limited to:</p>
                        <ul>
                            <li>Personal Information: Full name, identification numbers (e.g., ID card, passport), date of birth, address, email, phone number.</li>
                            <li>Account Information: Bank account details, transaction history, account balances.</li>
                            <li>Financial Information: Income details, credit score, employment status, and other relevant data for loan applications.</li>
                            <li>Technical Information: IP address, device information, browser type, and usage data when accessing our website or mobile app.</li>
                        </ul>
                    </li>
                    <br>
                    <li>
                        <strong>How We Use Your Data</strong><br>
                        <p>We use the collected data to:</p>
                        <ul>
                            <li>Process Transactions: Facilitate money transfers via the website and mobile app, ensuring that funds are accurately sent and received.</li>
                            <li>Loan Processing: Evaluate loan applications, determine eligibility, and manage loan accounts.</li>
                            <li>Customer Support: Respond to inquiries, provide customer service, and resolve disputes related to transfers or loans.</li>
                            <li>Compliance: Comply with legal and regulatory requirements, including anti-money laundering (AML) and know your customer (KYC) obligations.</li>
                            <li>Security Enhancements: Monitor and improve the security of our systems, preventing fraud and unauthorized access.</li>
                        </ul>
                    </li>
                    <br>
                    <li>
                        <strong> Data Sharing</strong>
                        <p>We may share your personal data with third parties under the following conditions:</p>
                        <ul>
                            <li>Service Providers: Third-party service providers who assist in processing transactions, managing loans, and maintaining the security of our services (e.g., payment processors, credit scoring agencies).</li>
                            <li>Legal Compliance: When required by law, regulatory authorities, or court orders.</li>
                            <li>Business Transactions: In the event of a merger, acquisition, or transfer of assets, your data may be transferred as part of that transaction, subject to confidentiality agreements.</li>
                        </ul>
                    </li>
                    <br>
                    <li>
                        <strong>Data Security</strong>
                        <p>We implement strict security measures to protect your personal data, including:</p>
                        <ul>
                            <li>Encryption: All sensitive data, such as transaction and loan details, are encrypted during transmission to prevent unauthorized access.</li>
                            <li>Access Control: Only authorized personnel have access to customer data, and they are bound by strict confidentiality agreements.</li>
                            <li>Regular Audits: We conduct regular security audits to ensure that our systems and data handling practices comply with industry standards.</li>
                        </ul>
                    </li>
                    <br>
                    <li>
                        <strong>Customer Rights</strong>
                        <p>You have the following rights regarding your personal data:</p>
                        <ul>
                            <li>Access: You may request a copy of your personal data that we hold.</li>
                            <li>Correction: You can request corrections to any inaccurate or outdated information.</li>
                            <li>Deletion: You may request the deletion of your personal data, subject to legal and regulatory retention requirements.</li>
                            <li>Data Portability: You have the right to request that your data be transferred to another service provider in a structured, machine-readable format.</li>
                        </ul>
                    </li>
                    <br>
                    <li>
                        <strong>Cookies and Tracking</strong>
                        <p>We use cookies and similar technologies to:</p>
                        <ul>
                            <li>Enhance user experience on our website and mobile app.</li>
                            <li>Track how you use our services to improve functionality and performance.</li>
                            <li>Analyze trends and manage customer interaction for marketing purposes.</li>
                        </ul>
                        <p>You can manage cookie preferences through your browser settings, but disabling cookies may limit some functionalities of our services.</p>
                    </li>
                    <br>
                    <li>
                        <strong>Data Retention</strong>
                        <p>We retain your personal data for as long as it is necessary to fulfill the purposes outlined in this Privacy Policy, including:</p>
                        <ul>
                            <li>Transaction Records: Retained for a minimum of [X years] in accordance with legal and regulatory requirements.</li>
                            <li>Loan Records: Retained for the duration of the loan plus any applicable statutory retention periods.</li>
                        </ul>
                    </li>
                    <br>
                    <li>
                        <strong>Third-Party Links</strong>
                        <p>Our website and mobile app may contain links to third-party websites. We are not responsible for the privacy practices or content of these external sites. We encourage you to review the privacy policies of those websites before providing any personal information.</p>
                    </li>
                    <br>
                    <li>
                        <strong>Changes to This Privacy Policy</strong>
                        <p>We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. Any changes will be communicated through our website, mobile app, or other channels. By continuing to use our services after changes are made, you acknowledge and agree to the updated terms.</p>
                    </li>
                    <br>
                    <li>
                        <strong>Contact Information</strong>
                        <p>If you have any questions or concerns about this Privacy Policy or how we handle your personal data, you may contact us at:</p>
                        <ul>
                            <li>Email: [BankName@gmail.com]</li>
                            <li>Phone: +62-2345-6789</li>
                            <li>Address: Tambakbayan Street No.88, Babarsari, Depok, Sleman, Indonesia</li>
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