<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Rakornas Aptikom 2021</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="RAKORNAS APTIKOM 2021" />
    <meta name="keywords" content="RAKORNAS APTIKOM 2021" />
    <meta content="Themesbrand" name="author" />
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset("assets/peserta/images") }}/logoAptikom.png">
    <!-- css -->
    <link href="{{ asset("assets/home") }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/home") }}/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />

    <!-- magnific pop-up -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/home") }}/css/magnific-popup.css" />

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset("assets/home") }}/css/swiper.min.css">

    <!--Slider-->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/home") }}/css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/home") }}/css/owl.theme.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/home") }}/css/owl.transitions.css" />
    <link href="{{ asset("assets/home") }}/css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!--Navbar Start-->
    <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-dark">
        <div class="container">
            <!-- LOGO -->
            <a class="navbar-brand logo text-uppercase" href="index-1.html">
                <!-- <img src="images/logo-light.png" class="logo-light" alt="" height="22">
                <img src="images/logo-dark.png" class="logo-dark" alt="" height="22"> -->
                <span style="color: white;"  class="logo-light" >Rakornas Aptikom 2021</span>
                <span  style="color: black;"  class="logo-dark" >Rakornas Aptikom 2021</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">

                
                <ul class="navbar-nav mx-auto navbar-center" id="mySidenav">
                    <li class="nav-item active">
                        <a href="/" class="nav-link">Home</a>
                    </li>
                    @if (!auth()->user())
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register/umum" class="nav-link">Register Umum</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register/anggota" class="nav-link">Register Anggota Aptikom</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register/pengurus" class="nav-link">Register Pengurus Aptikom</a>
                        </li>
                    @else
                    
                        @if (auth()->user()->is_admin == 1)
                            <li class="nav-item">
                                <a href="/admin/dashboard" class="nav-link">Akun</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="/peserta/app/acara" class="nav-link">Apps</a>
                            </li>
                            <li class="nav-item">
                                <a href="/peserta/dashboard" class="nav-link">Akun</a>
                            </li>
                        @endif
                    @endif

                </ul>

                {{-- <ul class="navbar-nav navbar-center">
                    <li class="nav-item">
                        <a href="" class="nav-link">Log In</a>
                    </li>
                    <li class="nav-item d-inline-block d-lg-none">
                        <a href="" class="nav-link">Sign Up</a>
                    </li>
                </ul> --}}
                {{-- @if (auth()->user())
                    @if (auth()->user()->is_admin == 1)
                        <div class="navbar-button d-none d-lg-inline-block">
                            <a href="/admin/dashboard" class="btn btn-sm btn-custom-light btn-rounded btn-round">Akun</a>
                        </div>                        
                    @else
                        <div class="navbar-button d-none d-lg-inline-block">
                            <a href="/peserta/dashboard" class="btn btn-sm btn-custom-light btn-rounded btn-round">Akun</a>
                        </div>                     
                    @endif
                @endif --}}
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- END HOME -->
    <section class="bg-home home-2" id="home">
        <div class="bg-overlay"></div>
        <div class="home-center">
            <div class="home-desc-center">

                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-11">
                            <div class="home-content text-center text-white my-4">

                                <h2 class="home-title mt-5"><span class="element" data-elements="RAKORNAS APTIKOM 2021"></span></h2>
                                <p class="text-white-50 f-16 mt-4">Memberdayakan Kecerdasan Artifisial untuk Percepatan Transformasi Digital  di Era Revolusi Industri 4.0</p>
                                <p class="text-white-50 f-10 "> <i>"Empowering Artificial Intelligence for Accelerating Digital Transformation in Industrial Revolution 4.0"</i> </p>
                                
                                <div class="pt-4 mt-1">
                                    <a href="/login" class="btn btn-primary btn-lg">Login <i
                                            class="mdi mdi-arrow-right ml-1"></i></a>
                                </div>


                                <!-- <div class="mt-5 pt-5 client-img">
                                    <h6 class="text-white-50 text-uppercase">Also Available</h6>
                                        <div id="client-logo" class="mt-5" >
                                            <div class="client-logo mt-2 mb-2">
                                                <img src="images/clients/img-1.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="client-logo mt-2 mb-2">
                                                <img src="images/clients/img-2.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="client-logo mt-2 mb-2">
                                                <img src="images/clients/img-3.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="client-logo mt-2 mb-2">
                                                <img src="images/clients/img-4.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="client-logo mt-2 mb-2">
                                                <img src="images/clients/img-5.png" class="img-fluid" alt="">
                                            </div>
                                            <div class="client-logo mt-2 mb-2">
                                                <img src="images/clients/img-6.png" class="img-fluid" alt="">
                                            </div>
                                        </div>

                                </div> -->
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- END HOME -->

    
    

    <!-- START COUNTER -->
    <section class="section pt-0 bg-light">

        <div class="container">

            <div class="row mt-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center features-img">
                        <img src="{{ asset("assets/img/rakornas.jpeg") }}" class="img-fluid mt-4" alt="">
                    </div>
                </div>
            </div>

            <!-- <div class="row mt-5 pt-5">
                <div class="col-lg-12">
                    <div class="text-center title-content">
                        <h6 class="text-uppercase f-14 text-primary">Fun Facts </h6>
                        <h2 class="mt-3">Learn More About Some<br> Fun Facts</h2>
                        <p class="text-muted mt-3">Aenean aliquam odio ut risus aliquam facilisis. Nam ac velit odio.
                            Fusce a leo vel ligula
                            <br> elementum feugiat id fringilla at, interdum in sem.
                        </p>
                    </div>
                </div>
            </div> -->

            <div class="row mt-5" id="counter">
                <div class="col-lg-4">
                    <div class="counter-box mt-4">
                        <div class="media box-shadow bg-white p-4 rounded">
                            <!-- <div class="counter-icon mr-3">
                                <i class="mdi mdi-gift text-primary h2"></i>
                            </div> -->
                            <div class="media-body text-center">
                                <h3 class="counter-count"> <span class="counter-value" data-count="850">850</span></h3>
                                <p class="mt-1 mb-0">Institusi</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="counter-box mt-4">
                        <div class="media box-shadow bg-white p-4 rounded">
                            <!-- <div class="counter-icon mr-3">
                                <i class="mdi mdi-gift text-primary h2"></i>
                            </div> -->
                            <div class="media-body text-center">
                                <h3 class="counter-count"> 1,560</h3>
                                <p class="mt-1 mb-0">Program Studi
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="counter-box mt-4">
                        <div class="media box-shadow bg-white p-4 rounded">
                            <!-- <div class="counter-icon mr-3">
                                <i class="mdi mdi-gift text-primary h2"></i>
                            </div> -->
                            <div class="media-body text-center">
                                <h3 class="counter-count">5,175</h3>
                                <p class="mt-1 mb-0">Anggota Terdaftar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END COUNTER -->

    <!-- START SCREENSHOT -->
    <section class="section" id="screenshot">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center title-content">
                        <h6 class="text-uppercase f-14 text-primary">Daftar Acara </h6>
                        <h2 class="mt-3">Daftar Acara Rakornas Aptikom 2021</h2>
                        <p class="text-muted mt-3">Memberdayakan Kecerdasan Artifisial untuk Percepatan Transformasi Digital  di Era Revolusi Industri 4.0
                        </p>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-12">
                    <div id="owl-carousel">
                        @foreach ($data as $item)
                            <div class=" testi-box bg-white mt-4 mb-5 mx-3 p-4 rounded">
                                    <div class="blog-box mt-4">
                                        <div class="blog-img"></div>
                                        <img src="{{ asset("assets/img/webinar")."/".$item->img }}" class="img-fluid rounded" alt="">
                                        <div class="blog-content p-3 bg-white box-shadow">
                                            <h6 class="text-primary f-14 mt-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y')}}</h6>
                                            <h5 class="mt-4 f-18"><a href="" class="text-dark">{{ $item->judul_acara }}</a></h5>
                                            <p class="text-muted">
                                                Tema : <b>{{ $item->tema }}</b>
                                                <br>
                                                status : @if ($item->id_status  == 1) 
                                                            <span class="text-primary" >Aktif</span>
                                                        @else
                                                            <span class="text-danger" >Tidak Aktif</span>
                                                        @endif
                                                <br>
                                                Jam : {{ date("H:i",strtotime($item->jam)) }} WIB - {{ date("H:i",strtotime($item->jam_akhir)) }} WIB  
                                            </p>
                                            <div class="mt-4 mb-3">
                                                <a style="width: 100% !important" href="/peserta/app/acara/daftar/{{ $item->id }}" class="btn btn-primary btn-lg">Daftar </a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        @endforeach

                </div>

            </div>
        </div>
        </div>
    </section>
    <!-- END SREENSHORT -->

    <!-- START CTA -->
    <section class="section" style="background-color: rgb(0, 27, 100);">
        <div class="bg-overlay-4"></div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cta-content text-white text-center">

                        <div class="text-center text-white">
                            <h6 class="text-uppercase desc-white f-14">Informasi</h6>
                            <h2 class="mt-4">Tata cara mendaftar Rakornas Aptikom 2021</h2>
                            <div class="mt-5">
                                <a href="" class="btn btn-primary">Klik Disini</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END CTA -->

    

    

    <!-- START FOOTER -->
    <section class="section  py-5 mt-5" style="background-color: black;">
        <!-- <div class="bg-overlay"></div> -->

        <div class="container">


            <div class="row mt-3">
                <div class="col-12">
                    <div class="footer-alt">
                        <ul class="list-inline footer-social float-right mb-0">
                            <li style="color: white;" class="list-inline-item">0821 - 1847 - 6100 (Kanisa Adjani) |</li>
                            <li style="color: white;" class="list-inline-item">0821 - 1848 - 0007 (Ismi) |</li>
                            <li style="color: white;" class="list-inline-item">0811 - 8300 - 996 (Sekretariat APTIKOM)</li>
                        </ul>
                        <div class="footer-info">
                            <p class="text-white-50">2021 © Aptikom</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END FOOTER -->

    <!-- javascript -->
    <script src="{{ asset("assets/home") }}/js/jquery.min.js"></script>
    <script src="{{ asset("assets/home") }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset("assets/home") }}/js/jquery.easing.min.js"></script>
    <script src="{{ asset("assets/home") }}/js/scrollspy.min.js"></script>
    <!-- olw- carousel -->
    <script src="{{ asset("assets/home") }}/js/owl.carousel.min.js"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset("assets/home") }}/js/jquery.magnific-popup.min.js"></script>
    <!-- typed -->
    <script src="{{ asset("assets/home") }}/js/typed.js"></script>
    <!-- swipper js -->
    <script src="{{ asset("assets/home") }}/js/swiper.min.js"></script>
    <script src="{{ asset("assets/home") }}/js/jquery.mb.YTPlayer.js"></script>
    <!--flex slider plugin-->
    <script src="{{ asset("assets/home") }}/js/jquery.flexslider-min.js"></script>
    <!-- counter init -->
    <script src="{{ asset("assets/home") }}/js/counter.init.js"></script>
    <!-- contact init -->
    <script src="{{ asset("assets/home") }}/js/contact.init.js"></script>
    <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>
    <script src="{{ asset("assets/home") }}/js/app.js"></script>

</body>

</html>