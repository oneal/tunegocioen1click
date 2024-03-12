@extends('web/layouts/master')

@section('styles')
@endsection

@section('content')
    <section>
        <div class="container mb-5" style="margin-top: 140px">

            @include('web.partials.info-top-section', ['title1' => 'El mejor almacén cerca de ti', 'title2' => 'Elige la categoría y la provincia en el buscador. Encuentra los almacenes que necesitas cerca de ti.'])
            <div class="row">
                <div class="col-sm-12 col-12 mb-5 d-xl-none d-lg-block d-md-block d-sm-block d-block">
                    <h1 class="h1-section">Almacenes</h1>
                    <hr>
                    <?php $mobile = true;?>
                    @include('web.partials.filter-category-province', [$mobile, $categories, $provincies])
                </div>
            </div>
            <div class="row mb-5">
                <?php $positions = $positionsLetter;?>
                @include('web.partials.ads-head', $positions)
            </div>
            <div class="row">
                <div class="col-sm-4 col-12 d-xl-block d-md-none d-sm-none d-none">
                    <h1 class="h1-section">Almacenes</h1>
                    <hr>
                    <?php $mobile = false;?>
                    @include('web.partials.filter-category-province', [$mobile, $categories, $provincies])
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-12">
                    <?php $positions = $positions20;?>
                    @include('web.partials.icons-position', $positions)
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
            <div class="row mt-3">
                <?php $positions = $positionsLetter;?>
                @include('web.partials.ads-extra-footer', $positions)
            </div>

            <div class="row mb-5 text-center mt-5">
                <h3><span class="border-item-menu-footer">|</span> Los almacenes más destacados en tu zona.</h3>
                <p>Tanto si eres profesional como particular, encuentra tu almacén de confianza más cercano. </p>
            </div>

            @include('web.partials.informacion-empresa', ['textWidget1' => 'Encuentra el almacén que tienes cerca de ti.', 'title3' => '¿Tienes un almacén de venta directa tanto a particulares como a profesionales?'])


            @include('web.partials.post-search', ['titlePosts'=> 'Noticias sobre los productos más demandados por nuestros usuarios.', 'posts' => $postsStores])
        </div>
        <input type="hidden" id="url" value="{{ route('store.index') }}"/>;
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection
