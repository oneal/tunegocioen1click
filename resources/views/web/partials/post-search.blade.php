@if(isset($posts) && count($posts) > 0)
    <div class="row mt-5 mb-5 background-widget-post-buscador">
        <h3 class="mt-3 mb-5 text-center"><span class="border-item-menu-footer">|</span> {{$titlePosts}}</h3>
        @foreach($posts as $post)
            <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-3 text-center">
                @include('web.partials.thumb-post', ['viewDescription' => true])
            </div>
        @endforeach
    </div>
@endif
