@extends('web/layouts/master')

@section('styles')
@endsection

@section('content')
    <section>
        <div class="container" style="margin-top: 140px">
            <div class="row ">
                <?php $positions = $positionsLetter;?>
                @include('web.partials.ads-head', $positions)
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-xs-12">
                    <h1 class="h1-home">Descubre, haz click y contacta: <br><span>Explora empresas locales a través de sus iconos en
                        nuestra plataforma innovadora.</span></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-12 col-md-12 col-12 div-icon">
                    <?php $positions = $positions20;?>
                    @include('web.partials.icons-position', $positions)
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-12 div-nota">
                    <img src="{{ Voyager::image('nota-1.jpg')}}" title="Tu negocio en un click" alt="Tu negocio en un click"/>
                    <p class="text-home-5">
                        <a href="{{ route('contact.index') }}" class="mas-info">Más información</a>
                    </p>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-12">
                    <?php $positions = $positionsOther20;?>
                    @include('web.partials.icons-position', $positions)
                </div>
            </div>
            <div class="row mt-5">
                <?php $positions = $positionsLetter;?>
                @include('web.partials.ads-footer', $positions)
            </div>
            <div class="row mt-5 text-home-7">
                <div class="col-md-4 col-sm-12 col-12 mt-lg-3">
                    <h3>Encuentra lo que necesitas</h3>
                </div>
                <div class="col-md-8 col-sm-12 col-12">
                    <div class="row">
                        <div class="d-none d-lg-block d-md-none d-sm-none d-xs-none col-lg-2">
                            <p class="text-home-7-p-i">
                                <i class="fa-solid fa-angles-right"></i>
                            </p>
                        </div>
                        <div class="col-lg-10 col-sm-12 col-12 mt-lg-3">
                            <p>Los <a href="{{ route('restaurant.index') }}">Bares y Restaurantes</a> mejor valorados en tu zona. Los <a href="{{ route('hotel.index') }}">Hoteles</a> con más encanto en España donde pasar unos días inolvidables.
                                Gran variedad de <a href="{{ route('store.index') }}">Almacenes</a> donde comprar todo tipo de material para el cambio de tu hogar. Los <a href="{{ route('professional.index') }}">Profesionales</a> más destacado que puedes
                            encontrar cerca de ti. Numerosas <a href="{{ route('workoffer.index') }}">Ofertas de empleo</a> en tu ciudad. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-12">
                    <div class="row mb-3">
                        <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                            <p class="text-center"><img src="{{ Voyager::image('profesionales-home.jpg')}}" title="profesionales" alt="profesionales" class="img-fluid maxheight"/></p>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 col-12 pt-4">
                            <h2 class="color-text-black">Profesionales</h2>
                            <p class="mb-2"><b>Aquí puedes encontrar los mejores profesionales cerca de ti.</b> Abogados, arquitectos, carpinteros, mecánicos, electricistas, fontaneros, gestores administrativos, pintores, construcción, instaladores de aires acondicionado y calefacción, técnicos en reparación de electrodomésticos, transportistas y más…</p>
                            <p><a href="{{ route('professional.index') }}" class="btn button-black btn-block">Descubre más profesionales</a></p>
                        </div>
                        <div class="d-none d-lg-block d-md-block d-sm-none d-xs-none col-lg-4 col-sm-12 col-12"></div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-lg-5 offset-lg-2 col-md-12 col-sm-12 offset-sm-0 col-12 pt-4">
                            <h2 class="color-text-black">Almacenes</h2>
                            <p class="mb-2"><b>¿Te gustaría realizar un proyecto y necesitas comprar material para hacerlo?</b> Te mostramos un amplio listado con los almacenes de material más importantes que puedes encontrar en tu localidad. Almacenes de venta a profesionales, como a particulares, donde encontrar todo lo necesario para tus nuevos proyectos.</p>
                            <p><a href="{{ route('store.index') }}" class="btn button-black btn-block">Descubre los almacenes mas cercanos</a></p>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                            <p class="text-center"><img src="{{ Voyager::image('almacenes-home.jpg')}}" title="Almacenes" alt="Almacenes" class="img-fluid maxheight"/></p>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                            <p class="text-center"><img src="{{ Voyager::image('hoteles-home.jpg')}}" title="Hoteles" alt="Hoteles" class="img-fluid maxheight"/></p>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 col-12 pt-4">
                            <h2 class="color-text-black">Hoteles</h2>
                            <p class="mb-2"><b>¿Buscas un hotel donde alojarte en tu próxima escapada?</b> En esta sección te mostramos una gran variedad de hoteles. Desde los hoteles más económicos, hasta los hoteles más espectaculares, pasando por los mejores hoteles con relación calidad-precio donde pasar esas vacaciones tan deseadas.</p>
                            <p><a href="{{ route('hotel.index') }}" class="btn button-black btn-block">Encuentra tu hotel ideal</a></p>
                        </div>
                        <div class="d-none d-lg-block d-md-block d-sm-none d-xs-none col-lg-4 col-sm-12 col-12"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-5 offset-lg-2 col-md-12 col-sm-12 offset-sm-0 col-12 pt-4">
                            <h2 class="color-text-black">Bares - Restaurantes</h2>
                            <p class="mb-2"><b>¿Buscas un lugar tranquilo donde tomar un desayuno? ¿Quieres juntarte con la familia o amigos para celebrar un evento especial?</b> Te presentamos un listado con los mejores bares y restaurantes que puedes encontrar en tu localidad. Acércate y disfruta de una variedad de sabores.</p>
                            <p><a href="{{ route('restaurant.index') }}" class="btn button-black btn-block">Entra en tu bar-restaurante</a></p>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                            <p class="text-center"><img src="{{ Voyager::image('restaurantes-home.jpg')}}" title="Bares - Restaurantes" alt="Bares - Restaurantes" class="img-fluid maxheight"/></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-5 col-md-12 col-sm-12 col-12 mb-lg-5">
                            <p class="text-center"><img src="{{ Voyager::image('ofertas-empleo-home.jpg')}}" title="Ofertas de empleo" alt="Ofertas de empleo" class="img-fluid maxheight"/></p>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 col-12 pt-5">
                            <h2 class="color-text-black">Ofertas de empleo</h2>
                            <p class="mb-2"><b>¿Estás buscando un nuevo empleo? ¿Quieres cambiar tu perfil profesional?</b> Entra y descubre nuestro buscador con las empresas de más relevancia de España. Aquí podrás encontrar multitud de ofertas de empleo que se ajustan a tu perfil profesional. Entra y descúbrelas.</p>
                            <p><a href="{{ route('workoffer.index') }}" class="btn button-black btn-block">Encuentra ofertas de empleo cerca de ti</a></p>
                        </div>
                        <div class="d-none d-lg-block d-md-none d-sm-none d-xs-none col-lg-4 col-sm-12 col-12"></div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 mb-5">
                <div class="col-sm-12">
                    <h3><span class="color-text-secundary1">Bienvenido</span> a tu negocio en un click</h3>
                    <p>Hoy en día internet está lleno de sitios web, herramientas y artículos de toda clase.</p>
                    <p>Por este motivo siempre es bueno encontrar un portal web donde cuiden la calidad en cada publicación, donde realicen un mantenimiento diario quitando información obsoleta y que sea 100%  fiable.</p>
                    <p><b class="color-text-secundary1">Nuestro objetivo general</b> es ofrecer un espacio simplificado, moderno, intuitivo y seguro donde buscar la información más completa sobre una temática concreta.</p>
                    <p>A parte, como objetivos más específicos, queremos presentar una plataforma que permita a las empresas anunciar sus servicios, instalaciones, productos y ofertas de forma original a un precio muy asequible. Todo ello con la información más completa y actualizada para el usuario final.</p>
                </div>
            </div>
            <div class="row mt-5 mb-5">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12 height-block-icon-home-black mb-3">
                    <p class="color-text-secundary1">Que ofrecemos en</p>
                    <h4>tunegocio1click<span class="color-text-secundary1">.online</span></h4>
                    <p><a href="" class="btn button-white btn-block">Información <i class="fa-solid fa-arrow-right"></i></a></p>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12 height-block-icon-home mb-3">
                    <img src="{{ Voyager::image('icons/publicaciones-actuales.png')}}" title="Publicaciones Actuales." alt="Publicaciones Actuales." class="icon-home">
                    <h4>Publicaciones Actuales.</h4>
                    <p>Un equipo de redactores dedicados a traer la información más actualizada de cada sección. Todo para que tengas un lugar de referencia a la hora de hacer tus búsquedas por la red.</p>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12 height-block-icon-home mb-3">
                    <img src="{{ Voyager::image('icons/desde-caulquier-dispositivo.png')}}" title="Desde cualquier navegador y cualquier dispositivo." alt="Desde cualquier navegador y cualquier dispositivo." class="icon-home">
                    <h4>Desde cualquier navegador y cualquier dispositivo.</h4>
                    <p>¿Eres de buscar información en tu Smartphone, Tablet o prefieres sentarte tranquilamente delante de tu ordenador? Sin problema, puedes navegar en nuestro portal desde donde quieras y sin ningún problema.</p>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12 height-block-icon-home mb-3">
                    <img src="{{ Voyager::image('icons/comparte-tus-busquedas.png')}}" title="Comparte tus búsquedas." alt="Comparte tus búsquedas." class="icon-home">
                    <h4>Comparte tus búsquedas.</h4>
                    <p>¿Has encontrado lo que estabas buscando y quieres compartirlo? Con solo unos pocos clics, podrás compartir toda la información que encuentres en nuestra web.</p>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12 height-block-icon-home mb-3">
                    <img src="{{ Voyager::image('icons/sin-registtros.png')}}" title="No tienes que registrarte ni usar ninguna cuenta." alt="No tienes que registrarte ni usar ninguna cuenta." class="icon-home">
                    <h4>No tienes que registrarte ni usar ninguna cuenta.</h4>
                    <p>Entra en nuestra web, busca lo que necesitas, guarda la información de contacto y ya está. Hasta la próxima vez que entres. No te pediremos que te registres, que te crees una cuenta, ni nada por el estilo.</p>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12 height-block-icon-home mb-3">
                    <img src="{{ Voyager::image('icons/originalidad-sencillez.png')}}" title="Original, moderno, intuitivo y sencillo." alt="Original, moderno, intuitivo y sencillo." class="icon-home">
                    <h4>Original, moderno, intuitivo y sencillo.</h4>
                    <p>Un tablero grafico donde ver las empresas más destacadas y mejor valoradas de cada sector. ¿Te gusta un icono? Pasa el ratón por encima y verás que sucede...</p>
                </div>
            </div>
        </div>
        <div class="content-gradient">
            <div class="container" style="padding: 20px">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-12" style="padding: 40px">
                        <p>
                            <img src="{{ Voyager::image('logotipo-7.png')}}" title="Tu negocio en un click" alt="tu negocio en un click" style="max-width: 100%"/>
                        </p>
                        <p class="text-price-home">
                            por solo <span class="price">2,5</span><span class="money">€</span><span class="mes">mes</span>
                        </p>
                        <p>
                            <a href="{{ route('contact.index') }}" class="btn button-black btn-block">Formulario de contacto</a>
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-12 col-12 height-block-icon-home-black width-block-icon-home-black">
                        <p>¿Tienes una empresa y quieres anunciarla? ¡Miles de personas al mes te pueden ver!</p>
                        <h4>¡Coloca el icono de tu empresa de forma rápida y sencilla!</h4>
                        <p>Tu icono en un click es la página de inicio favorita de muchos usuarios de internet. Explora y comparte las búsquedas de tus webs favoritas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
