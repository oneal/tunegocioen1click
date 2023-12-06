@extends('web/layouts/master')

@section('styles')
@endsection

@section('content')
    <section>
        <div class="container" style="margin-top: 140px">

            <div class="row ">
                <div class="col-sm-12 col-12">
                    <h2 class="text-center title-blog"><span class="border-item-menu-footer">|</span> Contacto</h2>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-12">
                    <h1 class="h1-home">Tu negocio en 1 click. <br/><span>Conecta con nosotros para resolver tus preguntas y
                        comentarios.</span></h1>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-sm-12 col-12">
                    <h3><span class="color-text-secundary1">Bienvenido</span> a tu negocio en un click. </h3>
                    <p><strong>Nuestro objetivo general es ofrecer un espacio simplificado, moderno, intuitivo y seguro donde buscar la información más completa sobre una temática concreta.</strong></p>
                    <p>A parte, como objetivos más específicos queremos presentar una plataforma que permita a las empresas anunciar sus servicios, instalaciones, productos y ofertas de forma original a un precio asequible. </p>
                    <p>Todo ello con la información más completa y actualizada para el usuario final. </p>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-8 col-sm-12 col-12 mt-4 mb-2">
                    <h3><span class="border-item-menu-footer">|</span> En qué podemos ayudarte</h3>
                    <p><strong><span class="color-text-secundary1">Ventajas de anunciarte en</span> tunegocioen1click<span class="color-text-secundary1">.online</span></strong></p>
                    <p>Sea cual sea tu profesión o servicio que ofrece tu empresa, queremos hacer crecer tu negocio.</p>
                    <p>Si eres particular o profesional y tienes alguna duda o problema, no dudes en contactar con nosotros.</p>
                </div>
                <div class="col-md-4 col-sm-12 col-12 text-right" style="margin-top: -15px">
                    <img src="{{ Voyager::image('atencion-al-cliente.jpg')}}" title="En que podemos ayudarte" alt="En que podemos ayudarte" class="img-widget-buscador">
                </div>
            </div>
            @include('web.partials.banner-tu-negocio-en-un-click')
            <div class="row mb-5">
                <div class="col-md-6 col-sm-12 col-12">
                    <div class="row mb-3">
                        <div class="col-12 col-12">
                            <div class="card contact-data">
                                <h4 class="card-header">Datos de contacto</h4>
                                <div class="card-body">
                                    <p style="color: red">* Obligatorio</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-12">
                            <form id="conctact" name="contact" action="{{ route('contact.sendcontact') }}" method="post">
                                @csrf
                                <div class="card mb-1">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label"><strong>Nombre *</strong></label>
                                            <input type="text" class="form-control input-contact @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Tu nombre *" aria-describedby="emailHelp" required>
                                            @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-1">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="email" class="form-label"><strong>Email *</strong></label>
                                            <input type="text" class="form-control input-contact @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Tu email *" aria-describedby="emailHelp" required>
                                            @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="message" class="form-label"><strong>Mensaje *</strong></label>
                                            <textarea class="form-control input-contact @error('message') is-invalid @enderror" id="message-c" name="message-c" placeholder="Escribe tu mensaje *" aria-describedby="emailHelp" required>{{ old('message-c') }}</textarea>
                                            @error('message')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="politica" name="politica" type="checkbox" value="" required>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                He leido y acepto la <a href="" data-bs-toggle="modal" data-bs-target="#politica-modal">política de privacidad</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn button-click">Enviar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-12">
                    <div class="row mb-4">
                        <div class="col-sm-12 col-12">
                            <h4 class="color-text-primary">Preguntas frecuentes</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <h5>¿Cómo puedo insertar el icono de mi empresa?</h5>
                            <p class="mt-4 mb-5">Sólo tiene que ponerse en contacto con nosotros por medio del formulario o mandando un correo electrónico. Nuestro equipo le contestará indicando los pasos que debe seguir.</p>
                            <h5>¿Cuánto cuesta tener el icono de mi empresa todo el año?</h5>
                            <p class="mt-4 mb-5">Tener su empresa anunciada en nuestro portal sólo le costaría 2,5€ al mes, o lo que es lo mismo, 30€ al año. Por esta mínima cantidad de dinero, la información de su empresa será vista por miles de personas.</p>
                            <h5>¿Puedo publicar contenido en la web?</h5>
                            <p class="mt-4 mb-4">Sí. Ya sea en forma de nota de prensa o de notica de blog, usted podrá publicar el contenido que desee. Para ello sólo tiene que contactar con nuestro equipo de redactores y le indicarán como hacerlo.</p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="content-black">
            <div class="container" style="padding: 20px">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-12" style="padding: 40px">
                        <p>
                            <img src="{{ Voyager::image('logotipo-8.png')}}" title="Tu negocio en un click" alt="tu negocio en un click" style="max-width: 100%"/>
                        </p>
                        <p class="text-price-home">
                            <span class="color-text-white">por solo</span><span class="price">2,5</span><span class="money">€</span><span class="mes">mes</span>
                        </p>
                        <p>
                            <a href="{{ route('contact.index') }}" class="btn button-click btn-block">Formulario de contacto</a>
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

    <div class="modal fade" id="politica-modal" tabindex="-1" aria-labelledby="politica-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">POLÍTICA DE PRIVACIDAD</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('web.partials.texto-politica-privacidad')
                </div>
            </div>
        </div>
    </div>
@endsection
