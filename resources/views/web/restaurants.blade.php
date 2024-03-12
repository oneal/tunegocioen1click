@extends('web/layouts/master')

@section('styles')
@endsection

@section('content')
    <section>
        <div class="container mb-5" style="margin-top: 140px">
            @include('web.partials.info-top-section', ['title1' => 'Bares y Restaurantes', 'title2' => 'Elige la provincia en el buscador. Encuentra los mejores bares y restaurantes para disfrutar con amigos y familia.'])
            <div class="row">
                <div class="col-sm-12 col-12 mb-5 d-lg-none d-md-block d-sm-block d-block">
                    <h1 class="h1-section">Bares-Restaurantes</h1>
                    <hr>
                    <?php $mobile = true;?>
                    @include('web.partials.filter-province', [$mobile, $provincies])
                </div>
            </div>
            <div class="row mb-5">
                <?php $positions = $positionsLetter;?>
                @include('web.partials.ads-head', $positions)
            </div>
            <div class="row">
                <div class="col-sm-4 col-12 d-lg-block d-md-none d-sm-none d-none">
                    <h1 class="h1-section">Bares-Restaurantes</h1>
                    <hr>
                    <?php $mobile = false;?>
                    @include('web.partials.filter-province', [$mobile, $provincies])
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <?php $positions = $positions20;?>
                    @include('web.partials.icons-position', $positions)
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <?php $positions = $positionsOther20;?>
                    @include('web.partials.icons-position', $positions)
                </div>
            </div>
            <div class="row mt-5">
                <?php $positions = $positionsLetter;?>
                @include('web.partials.ads-footer', $positions)
            </div>
            <div class="row mt-3">
                <?php $positions = $positionsLetter;?>
                @include('web.partials.ads-extra-footer', $positions)
            </div>

            <div class="row mb-5 text-center mt-5">
                <h3><span class="border-item-menu-footer">|</span> Los Bares y Restaurantes mejor valorados.</h3>
                <p>Encuentra Restaurantes temáticos, Gourmet, tipo buffet, de comida rápida, comida para llevar, etc.</p>
            </div>

            @include('web.partials.informacion-empresa', ['textWidget1' => 'Encuentra el Bar o Restaurante que tienes cerca de ti.', 'title3' => '¿Tienes un Bar o Restaurante y quieres darlo a conocer entre tus futuros clientes?'])


            @include('web.partials.post-search', ['titlePosts'=> 'Los mejores Bares y Restaurantes donde vivir una experiencia única.', 'posts' => $postsRestaurants])
        </div>
        <input type="hidden" id="url" value="{{ route('restaurant.index') }}"/>;
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection
