 <!-- BEGIN: Main Menu-->
 <div class="main-menu menu-fixed {{ ($type_device=='mobile') ? 'menu-dark':'menu-light' }} menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <!-- <img src="{{ asset('images/logo/ventonic-logo.png') }}" alt="Ventonic"> -->
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('home') }}">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0"><img src="{{ asset('images/logo/ventonic-logo-light.png') }}" class="img-ventonic" alt="Ventonic"></h2>

                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class=" navigation-header"><span>Apps</span>
            </li>

            @if (auth()->user()->is_admin)
                <li class=" nav-item">
                    <a href="#">
                        <i class="feather icon-settings"></i>
                        <span class="menu-title">Sistema</span>
                    </a>
                    <ul class="menu-content">
                        <li class="">
                            <a href="{{ route('app.email_templates.index') }}">
                                <i class="feather icon-file"></i>
                                <span class="menu-item">Plantillas de email</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class=" nav-item {{ App\Helpers\General::setActiveMenu('chat') }}">
                <a href="{{ route('chat') }}">
                    <i class="feather icon-message-square"></i>
                    <span class="menu-title">Chat</span>
                    <span class="badge badge badge-pill badge-primary float-right mr-2 chat-menu-notifications d-none"></span>
                </a>
            </li>

            <li class="nav-item {{ App\Helpers\General::setActiveMenu('events.calender') }}">
                <a href="{{ route('events.calender') }}">
                    <i class="feather icon-calendar"></i>
                    <span class="menu-title">Calendario</span>
                </a>
            </li>

            <li class="nav-item {{ App\Helpers\General::setActiveMenu('email') }}">
                <a href="{{ route('email') }}">
                    <i class="feather icon-mail"></i>
                    <span class="menu-title">Email</span>
                </a>
            </li>

            {{-- Oportunidades --}}
            @if(\Auth::user()->type=="E" || isset(auth()->user()->CompanyProfile))
                <li class=" nav-item {{ App\Helpers\General::setActiveMenu(['oportunity.saved', 'oportunity.list'], true) }}">
                    <a href="#">
                        <i class="feather icon-star"></i>
                        <span class="menu-title">Oportunidades</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ App\Helpers\General::setActiveMenu('oportunity.saved') }}">
                            <a href="{{ route('oportunity.saved') }}">
                                <i class="feather icon-list"></i>
                                <span class="menu-item">Mis oportunidades</span>
                            </a>
                        </li>
                        <li class="{{ App\Helpers\General::setActiveMenu('oportunity.list') }}">
                            <a href="{{ route('oportunity.list') }}">
                                <i class="feather icon-list"></i>
                                <span class="menu-item">Otras Empresas</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

           @if(\Auth::user()->type=="V" || isset(auth()->user()->sellerProfile))
                <li class=" nav-item"><a href="{{ route('oportunity.list') }}"><i class="feather icon-list"></i><span class="menu-item">Oportunidades</span></a></li>
           @endif

            {{-- No he tocado nada :) --}}

            {{-- Negociaciones Company --}}
            
                <li class=" nav-item {{ App\Helpers\General::setActiveMenu('negociaciones') }}">
                    <a href="{{route('negociaciones')}}">
                        <i class="feather icon-users"></i>
                        <span class="menu-title">Negociaciones</span>
                    </a>
                </li>
            

            {{-- Contactos --}}
            @if(isset(auth()->user()->sellerProfile) || isset(auth()->user()->CompanyProfile))
                <li class="nav-item {{ App\Helpers\General::setActiveMenu(['contact.list', 'contact.detail']) }}">
                    <a href="{{route('contact.list')}}">
                        <i class="feather icon-users"></i>
                        <span class="menu-title">Contactos</span>
                    </a>
                    {{-- <ul class="menu-content">
                        <li>
                            <a href="{{ route('contact.list') }}">
                                <i class="feather icon-user"></i>
                                <span class="menu-item">Buscar Contacto</span>
                            </a>
                        </li>
                    </ul> --}}
                </li>
            @endif

            <li class=" nav-item {{ App\Helpers\General::setActiveMenu('todos') }}">
                <a href="{{route('todos')}}">
                    <i class="feather icon-check-square"></i>
                    <span class="menu-title">Notas Personales</span>
                </a>
            </li>

            @if (\Auth::user()->type=="E")
                <li class=" nav-item {{ App\Helpers\General::setActiveMenu('apps') }}">
                    <a href="{{route('apps')}}">
                        <i class="feather icon-server"></i>
                        <span class="menu-title">Apps Gratis</span>
                    </a>
                </li>
            @endif

            <!--
            <li class=" nav-item {{ App\Helpers\General::setActiveMenu('widgets.data') }}">
                <a href="{{route('widgets.data')}}">
                    <i class="fa fa-tasks"></i>
                    <span class="menu-title">Datos de Call Me</span>
                </a>
            </li>
            -->

            @if (\Auth::user()->type=="E")
                <li class=" nav-item {{ App\Helpers\General::setActiveMenu('search.init') }}">
                    <a href="{{ route('search.init') }}">
                        <i class="feather icon-search"></i>
                        <span class="menu-item">Buscar Vendedor</span>
                    </a>
                </li>
            @endif



            {{-- <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title">{{ Auth::user()->name }}</span></a>
                <ul class="menu-content">
                    @if (auth()->user()->email_verified_at !== null)
                    <li><a href="{{ route('perfil.index') }}"><i class="feather icon-user"></i><span class="menu-item">Mi Perfil</span></a>
                    </li>
                    @endif
                    @if (\Auth::user()->type=="E")
                    <li><a href="{{ route('search.init') }}"><i class="feather icon-search"></i> <span class="menu-item">Buscar Vendedor</span></a>
                    </li>
                    @endif
                    <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="feather icon-power"></i> <span class="menu-item">{{ __('Salir') }}</span></a>
                    </li>
                </ul>
            </li> --}}

             {{-- Oportunidades --}}
            @if(\Auth::user())
                <li class=" nav-item {{ App\Helpers\General::setActiveMenu(['report.sales', 'oportunity.list'], true) }}">
                    <a href="#">
                        <i class="feather icon-bar-chart"></i>
                        <span class="menu-title">Informes</span>
                    </a>
                    <ul class="menu-content">
                        <!--
                        <li class="nav-item">
                            <a href="#" >
                                <i class="fa fa-cart-arrow-down"></i>
                                <span class="menu-item">Ventas</span>
                            </a>
                            <ul class="menu-content">
                                <li data-menu="">
                                    <a href="#" >
                                        <i class="fa fa-cart-arrow-down"></i>
                                        <span class="menu-item">Actividad</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        -->
                        <li class="{{ App\Helpers\General::setActiveMenu('report.sales') }}">
                            <a href="{{ route('report.sales') }}">
                                <i class="fa fa-cart-arrow-down"></i>
                                <span class="menu-item">Ventas</span>
                            </a>
                        </li>
                        <li class="{{ App\Helpers\General::setActiveMenu('report.activities') }}">
                            <a href="{{ route('report.activities') }}">
                                <i class="fa fa-bar-chart"></i>
                                <span class="menu-item">Actividad</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
<!-- END: Main Menu-->

