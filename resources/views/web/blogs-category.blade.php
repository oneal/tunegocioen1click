@extends('web/layouts/master')

@section('content')
    <section>
        <div class="container" style="margin-top: 100px">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <h2 class="text-center title-blog">Blog:{{ $category->name }}</h2>
                </div>
            </div>
            @if(isset($posts) && count($posts) > 0)
                <div class="row mt-5 mb-5">
                    <div class="col-sm-12">
                        <div class="row">
                            @foreach($posts as $post)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                    @include('web.partials.thumb-post', ['viewDescription' => false, 'color' => 'black'])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </section>
@endsection
