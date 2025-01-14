@extends('sidescreen')
@section('content')
<head>
    <title>Login</title>
    <style>
        body{
            padding: 0;
            margin: 0;
        }

        .navbar {
            background-color: transparent;
            justify-content: center;
        }

        .navbar .nav-link {
            color: white;
            padding: 0.5rem 2rem !important;
            position: relative;
        }

        .navbar .nav-link::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 0;
            height: 50%;
            width: 1px;
            background-color: white;
            transform: translateY(-50%);
        }

        .navbar .nav-item:last-child .nav-link::after {
            display: none;
        }

        @media (max-width: 1000px) {
            .navbar .nav-link::after {
                display: none;
            }
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 93.95vh;
        }

        /* Form input styles */
        form div {
            margin-bottom: 20px;
            
            /* max-width: 442px; */
        }

        form label {
            display: block;
            font-size: 1rem;
            color: white;
            margin-bottom: 8px;
            text-align: left;
        }

        form input {
            width: 40vw;
            height: 5vh;
            padding: 10px;
            font-size: 1rem;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .signbtn {
            width: 28vw;
            height: 5vh;
            font-size: 1rem;
            padding-top: 0.5rem;
            color: #243465;
            background: linear-gradient(to right, #00FFCC 0%, #13A7A8 100%);
            border: none;
            border-radius: 90px;
            cursor: pointer;
            font-weight: bold;
        }

        form p {
            color: white;
        }

        .link {
            color: #00FFCC; 
            text-decoration: none;
        }

        .forgot-password {
            text-align: right;
            margin-top: 8px;
        }

        .heading {
            color: #00FFCC;
            /* margin-bottom: 20px;
            width: 100%;
            max-width: 442px; */
        }

        /* .instructions {
            margin-bottom: 30px;
            width: 100%;
            max-width: 442px;
            font-size: 18px;
        } */

        .top-info {
            text-align: left;
        }

        .footer {
            background-color: transparent;
            text-align: center;
            padding: 20px 0;
        }

        form a, form input, form label{
            max-width: 442px;
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

<body class="antialiased" style="color: #F2F2ED;">
    <div class="content">
        <div>
            <div class="top-info mb-4">
                <div class="heading">
                    <h2>Welcome Back!</h2>
                </div>          
                <p>Please enter your Username and Password to continue</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your username" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group @error('password') mb-0 @enderror">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                        <span class="input-group-text password-toggle" onclick="togglePassword('password')">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="link forgot-password">
                        <a class="link" href="{{url('forgot')}}">Forgot Password?</a>
                    </div>
                </div>

                <button type="submit" class="signbtn">Log in</button>
            </form>
        </div>

        <div class="mt-5 mb-5">
            <p>Don't have an account? <a class="link" href="{{route('register.step1')}}">Sign Up</a></p>
        </div>

        <div class="mt-5">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('aboutUs')}}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('privacyPolicy')}}">Privacy Policy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('termsAndCondition')}}">Terms & Condition</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('home#kontak')}}">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </nav>
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
</body>
@endsection
