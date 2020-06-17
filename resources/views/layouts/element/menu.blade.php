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

            <li class=" nav-item"><a href="{{ route('chat') }}"><i class="feather icon-message-square"></i><span class="menu-title">Chat</span></a>
            </li>

        <li class=" nav-item"><a href="{{ route('events.calender') }}"><i class="feather icon-calendar"></i><span class="menu-title">Calendario</span></a>
            </li>

            <li class=" nav-item"><a href="#"><i class="feather icon-mail"></i><span class="menu-title">Email</span></a>
            </li>
            
            {{-- Oportunidades --}}
            @if(\Auth::user()->type=="E" || isset(auth()->user()->sellerProfile))
            <li class=" nav-item"><a href="{{ route('oportunity.list') }}"><i class="feather icon-star"></i><span class="menu-title">Oportunidades</span></a>
                @if(\Auth::user()->type=="E")
                <ul class="menu-content">
                    <li><a href="{{ route('oportunity.saved') }}"><i class="feather icon-list"></i><span class="menu-item">Mis oportunidades</span></a>
                    </li>
                </ul>
                @endif
            </li>
           @endif



            {{-- Negociaciones Company --}}
           @if(isset(auth()->user()->sellerProfile) || isset(auth()->user()->CompanyProfile))
           <li class=" nav-item"><a href="{{route('negociationCompany.index')}}"><i class="feather icon-users"></i><span class="menu-title">Negociaciones</span></a>
                <ul class="menu-content">
                    <li><a href="{{route('negociationCompany.index')}}"><i class="feather icon-users"></i><span class="menu-item">Negociaciones</span></a>
                    </li>
                </ul>
            </li>
            @endif

            {{-- Contactos --}}
           @if(isset(auth()->user()->sellerProfile) || isset(auth()->user()->CompanyProfile))
           <li class=" nav-item"><a href="#"><i class="feather icon-users"></i><span class="menu-title">Contacto</span></a>
                <ul class="menu-content">
                    <li>
                        <a href="{{route('contact.list')}}"><i class="feather icon-users"></i><span class="menu-item" data-i18n="Contacto">Buscar contacto</span></a>
                    </li>
                </ul>
            </li>
            @endif

            <li class=" nav-item"><a href="{{route('todos')}}"><i class="feather icon-check-square"></i><span class="menu-title">Todo</span></a>
            </li>

            @if (\Auth::user()->type=="E")
            <li><a href="{{ route('search.init') }}"><i class="feather icon-search"></i> <span class="menu-item">Buscar Vendedor</span></a>
            </li>
            @endif

            <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title">{{ Auth::user()->name }}</span></a>
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
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->

