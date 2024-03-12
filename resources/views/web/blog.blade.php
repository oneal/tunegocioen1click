@extends('web/layouts/master')

@section('styles')
@endsection

@section('content')
    <section>
        <div class="container" style="margin-top: 100px">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <h2 class="text-center title-blog"><span class="border-item-menu-footer">|</span> Blog</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-12">
                    <h1 class="h1-home">Ultimas noticias. <br/><span>Donde la Información encuentra la inspiración y la innovación.</span></h1>
                </div>
            </div>
            @if(isset($categories) && count($categories) > 0)
                <div class="row mt-5">
                    <div class="col-sm-12">
                        <?php $i = 1;?>
                        @foreach($categories as $category)
                            @if($i % 2 == 0)
                                <div class="row mb-5">
                                    <div class="col-md-5 offset-md-2 col-sm-6 offset-sm-0 col-12 mb-3">
                                        <h2 class="title-category-blog mb-5">{{ $category->name }}</h2>
                                        {!! $category->description !!}
                                        <a href="{{ route('blog.category.index', ['category' => $category->name_slug ]) }}" class="btn button-black btn-block">Noticias sobre {{$category->name}}</a>
                                    </div>
                                    <div class="col-md-5 col-sm-6 col-12">
                                        <div class="content-img" style="background-size: cover; background-position: center; background-image:url('{{ Voyager::image($category->image) }}'); width: 100%; height: 250px; display: block">
                                            <div class="bg-overlay">
                                                <div class="bg-overlay-content dark">
                                                    <a href="{{ route('blog.category.index', ['category' => $category->name_slug ]) }}" class="overlay-trigger-icon bg-light text-dark"><i class="fa-solid fa-plus"></i></a>
                                                </div>
                                                <div class="bg-overlay-bg dark"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row mb-5">
                                    <div class="col-md-5 col-sm-6 col-12 mb-3">
                                        <div class="content-img" style="background-size: cover; background-position: center; background-image:url('{{ Voyager::image($category->image) }}'); width: 100%; height: 250px; display: block">
                                            <div class="bg-overlay">
                                                <div class="bg-overlay-content dark">
                                                    <a href="{{ route('blog.category.index', ['category' => $category->name_slug ]) }}" class="overlay-trigger-icon bg-light text-dark"><i class="fa-solid fa-plus"></i></a>
                                                </div>
                                                <div class="bg-overlay-bg dark"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-6 col-12">
                                        <h2 class="title-category-blog mb-5">{{ $category->name }}</h2>
                                        {!! $category->description !!}
                                        <a href="{{ route('blog.category.index', ['category' => $category->name_slug ]) }}" class="btn button-black btn-block">Noticias sobre {{$category->name}}</a>
                                    </div>
                                </div>
                            @endif
                            <?php $i++;?>
                        @endforeach
                    </div>
                </div>
            @endif
            @if(isset($posts) && count($posts) > 0)
                <div class="row mt-5 mb-5 background-widget-post-buscador">
                    <div class="col-sm-12">
                        <div class="row">
                            <h3 class="mt-3 mb-5 text-center"><span class="border-item-menu-footer">|</span> ULTIMOS POST: PROFESIONALES, ALMACENES, HOTELES, BARES/RESTAURANTES </h3>
                            @foreach($posts as $post)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    @include('web.partials.thumb-post', ['viewDescription' => false, 'color' => 'white'])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
