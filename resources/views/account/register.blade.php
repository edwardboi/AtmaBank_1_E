@extends('sidescreen')
    @section('content')
    <head>
        <title>Register</title>
        <style>
            .navbar {
                background-color: transparent;
                justify-content: center;
            }

            .navbar .nav-link {
                color: white;
                padding: 0.5rem 2rem !important;
                border-right: 1px solid white; /* Add border for larger screens */
            }

            .navbar .nav-item:last-child .nav-link {
                border-right: none;
            }

            
            @media (max-width: 1000px) {
                .navbar .nav-link {
                    border-right: none; 
                }
            }

            .content {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 93.95vh;
                text-align: center;
            }

            /* Form input styles */
            form div {
                margin-bottom: 20px;
                width: 100%;
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
            }

            .top-info {
                /* width: 29vw; */
                text-align: start;
            
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
                <div class="top-info mb-2">
                    <div class="heading">
                        <h2>Create your account</h2>
                    </div>
                    <p>Please fill the blank space below</p>
                </div>
                
                <form action="{{ route('register.step1.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full name</label>
                        <input type="text" class="form-control" id="nama_nasabah" name="nama_nasabah" placeholder="Enter your name" value="{{ old('nama_nasabah') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="birthdate" class="form-label">Date of birth</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone number</label>
                        <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Enter your phone number" value="{{ old('nomor_telepon') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter your address" value="{{ old('alamat') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your e-mail" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            <span class="input-group-text password-toggle" onclick="togglePassword('password')">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Re-enter password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter your password" required>
                            <span class="input-group-text password-toggle" onclick="togglePassword('password_confirmation')">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                        @error('error')
                            <div class="alert alert-danger"> X {{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="signbtn btn">Continue</button>
                </form>
            </div>

            <!-- <div class="mt-5 mb-5">
                <p>Already have an account? <a class="link" href="{{url('login')}}">Login</a></p>
            </div> -->
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