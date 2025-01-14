<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous">


    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
            background: linear-gradient(#13A7A8 0%, #2A407E 83%);
            
        }

        .sidebar {
            background: linear-gradient(#13A7A8 0%, #2A407E 83%);
            color: white;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* height: 100; */
            position: relative;
        }

        .sidebar img {
            width: 442px;
            height: auto;
            object-fit: contain;
            position: relative;
            z-index: 1;
        }

        .bank-name {
            font-size: 3rem;
            background: -webkit-linear-gradient(0deg, #00FFCC 0%, #00997A 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: absolute;
            top: 70%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-weight: bold;
            z-index: 2;
        }

        .content-wrapper {
            background-color: rgba(32, 45, 88, 0.8);
            padding: 2rem;
            position: relative;
        }

        .main-footer {
            background-color: transparent;
            color: white;
            padding: 10px;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 d-none d-md-flex sidebar">
                <a href="{{url(path: 'home')}}">
                    <img src="/img/Bank Logo.png" alt="Bank Logo">
                </a>
                <h1 class="bank-name" style="margin-top: 7vh;">AtmaBank</h1>
            </div>

            <div class="col-12 col-md-6 content-wrapper">
                @yield('content')
                <br>
                <br>
                <footer class="main-footer">
                    Copyright &copy; {{ date('Y') }}. All rights reserved.
                </footer>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
</body>
</html>