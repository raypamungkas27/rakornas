<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>Rakornas Aptikom 2021 | @yield('title') </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset("assets/peserta/images") }}/logoAptikom.png">
    <link
        href="{{ asset("assets/peserta") }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css"
        rel="stylesheet">
    <link href="{{ asset("assets/peserta") }}/css/style.css" rel="stylesheet">

    @yield('css')

</head>

<body class="vh-100">
    @include('sweetalert::alert')
    <div class="authincation h-100">
        <div class="container h-100 pb-5">
            <div class="row justify-content-center h-100 align-items-center mt-5">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    {{-- <div class="text-center mb-3">
										<img src="{{ asset("assets/peserta") }}/images/logo-full.png" alt="">
                                </div> --}}

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
                                @yield('content')
                                <hr>
                                <div class="text-center">
                                    <a href="/" class="text-info mt-5" >Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset("assets/peserta") }}/vendor/global/global.min.js"></script>
    <script
        src="{{ asset("assets/peserta") }}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js">
    </script>
    <script src="{{ asset("assets/peserta") }}/js/custom.min.js"></script>
    <script src="{{ asset("assets/peserta") }}/js/deznav-init.js"></script>

    @yield('js')


</body>

</html>
