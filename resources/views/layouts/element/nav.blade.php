<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="float-left mr-auto bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="mr-auto nav-item mobile-menu d-xl-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
                         <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{ route('home') }}" data-toggle="tooltip" data-placement="top" title="Dashboard"><i class="ficon fa fa-home"></i></a>
                        </li>

                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{ route('chat') }}" data-toggle="tooltip" data-placement="top" title="Chat"><i class="ficon feather icon-message-square"></i></a>
                        </li>

                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="calender" data-toggle="tooltip" data-placement="top" title="Calendario"><i class="ficon feather icon-calendar"></i></a>
                        </li>

                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{ route('email') }}" data-toggle="tooltip" data-placement="top" title="Email"><i class="ficon feather icon-mail"></i></a>
                        </li>


                        @if(\Auth::user()->type=="E" || isset(auth()->user()->sellerProfile))
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{ route('oportunity.list') }}" data-toggle="tooltip" data-placement="top" title="Oportunidades"><i class="ficon feather icon-star"></i></a>
                        </li>
                        @endif

                        @if(\Auth::user()->type=="E" || isset(auth()->user()->sellerProfile))
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{ route('negociaciones') }}" data-toggle="tooltip" data-placement="top" title="Negociaciones"><i class="ficon feather icon-users"></i></a>
                        </li>
                        @endif

                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{route('contact.list')}}" data-toggle="tooltip" data-placement="top" title="Contactos"><i class=" ficon fa fa-book"></i></a>
                        </li>

                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{route('todos')}}" data-toggle="tooltip" data-placement="top" title="Notas Personales"><i class="ficon feather icon-check-square"></i></a>
                        </li>
                        @if (\Auth::user()->type=="E")
                         <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{route('apps')}}" data-toggle="tooltip" data-placement="top" title="Apps Gratis"><i class="ficon feather icon-server"></i></a>
                        </li>

                         <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{route('search.init')}}" data-toggle="tooltip" data-placement="top" title="Buscar Vendedor"><i class="ficon feather icon-search"></i></a>
                        </li>
                        @endif

                         <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{route('report.sales')}}" data-toggle="tooltip" data-placement="top" title="Informe de Ventas"><i class="ficon feather icon-bar-chart"></i></a>
                        </li>

                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{route('group.show')}}" data-toggle="tooltip" data-placement="top" title="Grupo de Usuarios"><i class="ficon fa fa-users"></i></a>
                        </li>

                    </ul>

                </div>
                <ul class="float-right nav navbar-nav">
                    <li>
                    {{-- Notificaciones --}}
                    @include('includes.notifications')
                    {{-- Fin notificaciones --}}
                    </li>
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown" id="usermenu-link">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name text-bold-600">{{ Auth::user()->name.' '. strtoUpper(substr(Auth::user()->last_name,0,1)).'.' }} </span>
                                <span class="user-status">Disponible</span>
                            </div>
                            <span>
                                @empty(Auth::user()->photo)
                                    <img class="round" src="/images/anonymous-user.png" alt="{{ Auth::user()->name }} " height="40" width="40">
                                @else
                                    <img class="round" src="/{{ Auth::user()->photo }}" alt="{{ Auth::user()->name }} " height="40" width="40">
                                @endempty
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right superior" id="usermenu-nav">

                            <a class="dropdown-item" href="{{ route('perfil.index') }}"><i class="fa fa-id-badge"></i> Mi Perfil</a>
                             @if (auth()->user()->email_verified_at !== null)
                                <a class="dropdown-item" href="{{ route('myaccount') }}">
                                    <i class="fa fa-id-card"></i> Mi Cuenta
                                </a>
                            @endif
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="feather icon-power"></i> {{ __('Salir') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="cursor-pointer auto-suggestion d-flex align-items-center justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="mr-75 feather icon-alert-circle"></span><span>No results found.</span></div>
        </a></li>
</ul>
