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
            input[type="number"]::-webkit-outer-spin-button,
            input[type="number"]::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
            input[type="file"]{
                height: 5vh;
                border: none;
                border-radius: 6px;
            }
            
            input[type="file"]::file-selector-button {
                height: 5vh;
                background: #3850A0;
                border: none;
                color: white;
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
                
                <form action="{{ route('register.step2.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="idnumber" class="form-label">ID number</label>
                        <input type="number" class="form-control" id="id_number" name="id_number" placeholder="Enter your ID number" required>
                        @error('id_number')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="foto_idnumber" class="form-label">Upload your ID card</label>
                        <input type="file" class="form-control" id="foto_idnumber" name="foto_idnumber" placeholder="Upload your ID card" required>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" value="termspolicy" id="flexCheckDefault" name="centang" required>
                        <label class="form-check-label" for="flexCheckDefault">
                            By creating an account means you agree to the <a class="link" href="{{url('/termsAndCondition')}}">Terms and Conditions</a>, and our <a class="link" href="{{url('/privacyPolicy')}}">Privacy Policy</a>
                        </label>
                    </div>

                    <button type="submit" class="signbtn">Sign up</button>
                </form>
            </div>
            <div class="mt-5 mb-5">
                <p>Already have an account? <a class="link" href="{{route('login.show')}}">Login</a></p>
            </div>
        </div>
    </body>
    @endsection