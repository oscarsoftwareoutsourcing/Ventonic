<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Ventonic" />
    <meta name="description" content="Ventonic" />
    <meta name="author" content="potenzaglobalsolutions.com" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
     <!-- Google Font -->
     <link href="https://fonts.googleapis.com/css?family=Heebo:400,500,700%7CMontserrat:300,400,500,600,700,800&amp;display=swap" rel="stylesheet">

    <!-- Styles 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('web/css/font-awesome/all.min.css') }}"" />
    <link rel="stylesheet" href="{{ asset('web/css/flaticon/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/css/bootstrap/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/css/owl-carousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/css/magnific-popup/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/css/swiper/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/css/animate/animate.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('web/images/favicon.ico') }}"/>

    
    @yield('extra-css')
</head>
<body>
    
    <!--================================= header-transparent header-03
    Header -->
    <header class="header header-sticky header-transparent">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav class="navbar navbar-expand-lg">
                <!-- Logo START -->
                <a class="navbar-brand" href="{{ url('/') }}">
                  <img class="img-fluid" src="web/images/logo-ventonic.png" alt="">
                </a>
                <!-- Logo END -->
  
                <!-- Navbar toggler START -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar toggler END -->
  
                <!-- Navbar START -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav m-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="#" role="button"  aria-haspopup="true" aria-expanded="false">Página principal</a>
  
                    </li>
                    <li class="nav-item">
                      <a class="nav-link"  href="{{ route('register', ['type' => 'empresa']) }}" role="button"  aria-haspopup="true" aria-expanded="false">Quiero un Vendedor</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Quiero Vender</a>
                    </li>

                    @guest
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Iniciar Sesión<i class="fas fa-chevron-down fa-xs"></i>
                        </a>
                        <!-- Dropdown Menu -->
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{ route('login', ['type' => 'empresa']) }}">
                            {{ __('Empresa') }}</a>
                        </li>
                          <li><a class="dropdown-item" href="{{ route('login', ['type' => 'vendedor']) }}">
                            {{ __('Vendedor') }}</a></li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link " role="button" aria-haspopup="true" aria-expanded="false" href="{{ route('home') }}">{{ __('Inicio') }}</a>
                      </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  v-pre>
                            {{ Auth::user()->name }}<i class="fas fa-chevron-down fa-xs"></i>
                        </a>
                        <!-- Dropdown Menu -->
                        <ul class="dropdown-menu">
                         @if (auth()->user()->email_verified_at !== null)
                         <li>
                         <a class="dropdown-item" href="{{ route('perfil.index') }}">
                                {{ __('Perfil') }}
                            </a>
                        </li>
                        @endif
                        
                          <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                            </form>


                          </li>
                        </ul>
                    </li>
                        
                    @endguest
                    <li class="nav-item">
                      <a class="nav-link " href="#" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                    </li>
                   
                  </ul>
                </div>
                <!-- Navbar END -->
  
                <div class="mr-5 mr-lg-0 d-sm-flex d-none align-items-center">
                  <!-- Search icon START -->
                  <div class="search mr-4">
                    <a class="search-btn not_click" href="javascript:void(0);"></a>
                    <div class="search-box not-click">
                      <form action="#" method="get">
                        <input type="text" class="not-click form-control" name="search" placeholder="Buscar.." value="" autofocus>
                        <button class="search-button" type="submit"><i class="fa fa-search not-click"></i></button>
                      </form>
                    </div>
                  </div>
                  <!-- Search icon END -->
  
                
                </div>
              </nav>
            </div>
          </div>
        </div>
      </header>
      <!--=================================
      Header -->

    
        <div id="app">
            @yield('content')
        </div>
     

   <!--=================================
    Footer -->
    <footer class="footer bg-dark-gradient space-ptb">
      <div class="container">
        <div class="row align-items-center mb-4 mb-lg-5">
          <div class="col-lg-5  mb-4 mb-lg-0">
            <div class="social-icon social-icon-02">
              <ul>
                <li>
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-7">
            <div class=" row align-items-center">
              <div class="col-md-5 mb-4 mb-md-0">
                <h5 class="mb-0 text-white">Suscríbete a la Newsletter</h5>
              </div>
              <div class="col-md-7">
              <form class="subscribe">
                <div class="form-group mb-0">
                  <input type="email" class="form-control" placeholder="Escribe aquí tu email">
                </div>
                <button type="submit" class="btn-arrow arrow-gradient"><span></span></button>
              </form>
               </div>
            </div>
          </div>
        </div>
        <div class="row bg-white m-0 p-4 p-lg-5 position-relative z-index-9">
          <div class="col-lg-5 col-md-6 mb-4 mb-lg-2">
            <div class="pr-xl-6">
              <!-- Logo START -->
              <a class="mb-4 d-inline-block" href="index.html">
                <img class="img-fluid" src="web/images/logo.png" alt="">
              </a>
              <!-- Logo END -->
              <p class="lead text-dark mb-0">Información general de la Empresa</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 mb-4 mb-lg-2">
            <div class="contact-info">
              <h5 class="mb-4">Contacto</h5>
              <ul class="list-unstyled mb-0">
                <li><i class="fas fa-map-marker-alt text-primary"></i><span>Dirección</span></li>
                <li><i class="far fa-envelope text-primary"></i><span>infok@ventonic.com</span></li>
                <li><i class="fas fa-phone-alt text-primary"></i><span>+(000) 000-0000</span></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-2 col-sm-6 mb-4 mb-md-2">
            <div class="footer-link">
              <h5 class="mb-4">Ayuda</h5>
              <ul class="list-unstyled mb-0">
                <li><a href="#">Blog</a></li>
                <li><a href="#">Help Center</a></li>
                <li><a href="#">Contacto</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-2 col-md-6 mb-0">
            <div class="footer-link">
              <h5 class="mb-4">Empresa</h5>
              <ul class="list-unstyled mb-0">
                <li><a href="#">Home</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Shortcode</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-12 mt-5">
            <p class="mb-0 text-dark">© Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span> <a href="index.html"> Ventonic </a> All Rights Reserved.</p>
          </div>
        </div>
      </div>
      <!-- SVG START -->
      <div class="position-absolute left-0 bottom-0 ml-n6 d-none d-md-block">
        <svg xmlns="http://www.w3.org/2000/svg" width="400px" height="400px" viewBox="0 0 574 574">
          <path id="Shape_615_copy" data-name="Shape 615 copy" class="fill-primary opacity-10" d="M319,5050.99c-158.511,0-287.011,128.5-287.011,287.01S160.491,5625.01,319,5625.01,606.014,5496.51,606.014,5338,477.515,5050.99,319,5050.99Zm0,483.39c-108.455,0-196.376-87.92-196.376-196.38S210.547,5141.63,319,5141.63,515.379,5229.55,515.379,5338,427.459,5534.38,319,5534.38Z" transform="translate(-32 -5051)"/>
        </svg>
      </div>
      <!-- SVG END -->
    </footer>
    <!--=================================
    Footer -->

    <!--=================================
    Back To Top -->
    <div id="back-to-top" class="back-to-top">up</div>
    <!--=================================
    Back To Top -->

   
    <!--=================================
    Javascript -->

    <!-- JS Global Compulsory (Do not remove) -->
    <script src="{{ asset('web/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('web/js/popper/popper.min.js') }}"></script>
    <script src="{{ asset('web/js/bootstrap/bootstrap.min.js') }}"></script>

    <!-- Page JS Implementing Plugins (Remove the plugin script here if site does not use that feature) -->
    <script src="{{ asset('web/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('web/js/counter/jquery.countTo.js') }}"></script>
    <script src="{{ asset('web/js/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web/js/swiper/swiper.min.js') }}"></script>
    <script src="{{ asset('web/js/swiperanimation/SwiperAnimation.min.js') }}"></script>
    <script src="{{ asset('web/js/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <!-- Template Scripts (Do not remove) -->
    <script src="{{ asset('web/js/custom.js') }}"></script>

    @yield('extra-js')
</body>
</html>
