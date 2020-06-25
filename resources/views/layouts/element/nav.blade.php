<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
                        
                        <!-- li.nav-item.mobile-menu.d-xl-none.mr-auto-->
                        <!--   a.nav-link.nav-menu-main.menu-toggle.hidden-xs(href='#')-->
                        <!--     i.ficon.feather.icon-menu-->
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{route('todos')}}" data-toggle="tooltip" data-placement="top" title="Notas Personales"><i class="ficon feather icon-check-square"></i></a>
                        </li>
                        
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{ route('chat') }}" data-toggle="tooltip" data-placement="top" title="Chat"><i class="ficon feather icon-message-square"></i></a>
                        </li>
                        
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{ route('email') }}" data-toggle="tooltip" data-placement="top" title="Email"><i class="ficon feather icon-mail"></i></a>
                        </li>
                        
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="calender" data-toggle="tooltip" data-placement="top" title="Calendario"><i class="ficon feather icon-calendar"></i></a></li>
                        
                        @if(\Auth::user()->type=="E" || isset(auth()->user()->sellerProfile))
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{ route('oportunity.list') }}" data-toggle="tooltip" data-placement="top" title="Oportunidades"><i class="ficon feather icon-star warning"></i></a>
                        </li>
                        @endif

                        @if(\Auth::user()->type=="E" || isset(auth()->user()->sellerProfile))
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="{{ route('negociationCompany.index') }}" data-toggle="tooltip" data-placement="top" title="Negociaciones"><i class="ficon feather icon-users"></i></a>
                        </li>
                        @endif

                    </ul>

                    {{-- <ul class="nav navbar-nav">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon feather icon-star warning"></i></a>
                            <div class="bookmark-input search-input">
                                <div class="bookmark-input-icon"><i class="feather icon-search primary"></i></div>
                                <input class="form-control input" type="text" placeholder="Buscar en Ventonic..." tabindex="0" data-search="template-list">
                                <ul class="search-list search-list-bookmark"></ul>
                            </div>
                            <!-- select.bookmark-select-->
                            <!--   option Chat-->
                            <!--   option email-->
                            <!--   option todo-->
                            <!--   option Calendar-->
                        </li>
                    </ul> --}}
                </div>
                <ul class="nav navbar-nav float-right">

                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>

                    <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon feather icon-search"></i></a>
                        <div class="search-input">
                            <div class="search-input-icon"><i class="feather icon-search primary"></i></div>
                            <input class="input" type="text" placeholder="Buscar en Ventonic..." tabindex="-1" data-search="template-list">
                            <div class="search-input-close"><i class="feather icon-x"></i></div>
                            <ul class="search-list search-list-main"></ul>
                        </div>
                    </li>
                    <li>
                    {{-- Notificaciones --}}

                    @include('includes.notifications')

                    {{-- Fin notificaciones --}}
                    </li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{ Auth::user()->name.' '. strtoUpper(substr(Auth::user()->last_name,0,1)).'.' }} </span><span class="user-status">Disponible</span></div><span><img class="round" src="/{{ Auth::user()->photo }}" alt="{{ Auth::user()->name }} " height="40" width="40"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            
                            <a class="dropdown-item" href="{{ route('perfil.index') }}"><i class="fa fa-id-badge"></i> Mi Perfil</a>
                             @if (auth()->user()->email_verified_at !== null) 
                                <a class="dropdown-item" href="#"><i class="fa fa-id-card"></i> Mi Cuenta</a>
                                <a class="dropdown-item" href="#"><i class="feather icon-user"></i> Usuarios</a>
                                <a class="dropdown-item" href="{{ route('group.show') }}"><i class="feather icon-users"></i> Grupo de Usuarios</a>

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
    <li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="mr-75 feather icon-alert-circle"></span><span>No results found.</span></div>
        </a></li>
</ul>