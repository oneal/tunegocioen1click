<!DOCTYPE html>
<html lang="es">
<head>
    @include('web.layouts.partials.metas')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.min.css')}}?v={{time()}}">
    <link rel="icon" type="image/x-icon" href="{{ Voyager::image('favicon.ico')}}">
    <script src="https://kit.fontawesome.com/2ed6a9172f.js" crossorigin="anonymous"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZQJPQ87WQT"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){
            dataLayer.push(arguments);
        }
        gtag('js', new Date()); gtag('config', 'G-ZQJPQ87WQT');
    </script>
    @yield('styles')
</head>
<body>
    @include('web.layouts.partials.header')
    @yield('content')
    @include('web.layouts/partials/footer')
{{--    <div id="cookies">--}}
{{--        <div class="inner">--}}
{{--            {{ trans('global.solicita-su-permiso-obtener-datos-estadisticos') }} <br> {{ trans('global.continua-navegando-uso-cookies') }}--}}
{{--            <a href="javascript:void(0);" class="ok" onclick="setLegalCookie();"><b>{{ _('OK') }}</b></a>--}}
{{--        </div>--}}
{{--    </div>--}}
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script type="text/javascript" src="{{asset('js/app.min.js')}}?v={{time()}}"></script>
    @yield('scripts')
</body>

</html>
