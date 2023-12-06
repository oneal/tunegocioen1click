<footer id="footer">
    <div class="background-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 mb-4 text-sm-center text-center text-md-start">
                    <p class="img-logo-footer">
                        <img src="{{ Voyager::image('logotipo-6.png')}}" alt="Tu negocio en un click" title="Tu negocio en un click">
                    </p>
                    <p class="text-email-footer">
                        <a href="mailto:info@tunegocioen1click.online"><i class="fa-regular fa-envelope"></i> info@tunegocioen1click.online</a>
                    </p>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <p class="ms-md-3">
                                <a class="item-menu-footer fs-2" href="#"><img src="{{ Voyager::image('icons/youtube.png')}}" alt="Tu negocio en un click" title="Tu negocio en un click" style="max-width: 32px"></a>
                                <a class="item-menu-footer fs-2 ms-1" href="#"><img src="{{ Voyager::image('icons/twitter.png')}}" alt="Tu negocio en un click" title="Tu negocio en un click" style="max-width: 32px"></a>
                                <a class="item-menu-footer fs-2 ms-1" href="#"><img src="{{ Voyager::image('icons/instagram.png')}}" alt="Tu negocio en un click" title="Tu negocio en un click" style="max-width: 32px"></a>
                                <a class="item-menu-footer fs-2 ms-1" href="#"><img src="{{ Voyager::image('icons/facebook.png')}}" alt="Tu negocio en un click" title="Tu negocio en un click" style="max-width: 32px"></a>
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-12 mb-4 text-sm-center text-center text-md-start">
                    <h5 class="item-menu-footer fs-3"><span class="border-item-menu-footer">|</span> Enlaces</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link item-menu-footer" href="{{ route('home.index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link item-menu-footer" href="{{ route('blog.index') }}">Buscador</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link item-menu-footer" href="{{ route('blog.index') }}">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link item-menu-footer" href="{{ route('contact.index') }}">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link item-menu-footer" href="{{ route('privacy.politic') }}">Política de privacidad</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link item-menu-footer" href="{{ route('legal') }}">Aviso legal</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-12 mb-4 text-sm-center text-center text-md-start">
                    <h5 class="item-menu-footer fs-3"><span class="border-item-menu-footer">|</span> Categorias</h5>
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link item-menu-footer" href="{{ route('professional.index') }}">Profesionales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link item-menu-footer" href="{{ route('store.index') }}">Almacenes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link item-menu-footer" href="{{ route('restaurant.index') }}">Bares/restaurantes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link item-menu-footer" href="{{ route('hotel.index') }}">Hoteles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link item-menu-footer" href="{{ route('workoffer.index') }}">Ofertas de trabajo</a>
                        </li>
                    </ul>
                </div>


            </div>

        </div>
    </div>
</footer>
