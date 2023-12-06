<header>
    <nav class="navbar navbar-expand-lg fixed-top background-menu">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <h1 class="text-logo">
                    <img src="{{ Voyager::image('logo.png')}}" title="Tu negocio en un click" alt="Tu negocio en un click" width="100%" height="54" class="d-inline-block">
                </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" style="position: absolute; right: 5px">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="float-md-end">
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Tu negocio en un click</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 float-lg-end">
                            <li class="nav-item">
                                <a class="nav-link @if(isset($activeHome)) active @endif" aria-current="page" href="{{ route('home.index') }}">Inicio</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle @if(isset($activeBuscar)) active @endif"  id="menu-item-buscar" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Buscar
                                </a>
                                <ul class="dropdown-menu menu-header" id="sub-menu-buscar">
                                    <li><a class="dropdown-item menu-header-item" href="{{route('professional.index')}}">Profesionales</a></li>
                                    <li><a class="dropdown-item menu-header-item" href="{{route('store.index')}}">Almacenes</a></li>
                                    <li><a class="dropdown-item menu-header-item" href="{{route('hotel.index')}}">Hoteles</a></li>
                                    <li><a class="dropdown-item menu-header-item" href="{{route('restaurant.index')}}">Bares restaurantes</a></li>
                                    <li><a class="dropdown-item menu-header-item" href="{{route('workoffer.index')}}">Ofertas de empleo</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link @if(isset($activeBlog)) active @endif" href="{{ route('blog.index') }}">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(isset($activeContacto)) active @endif" href="{{ route('contact.index') }}">Contacto</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
