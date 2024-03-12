<div class="content-img" style="background-size: cover; background-position: center; background-image:url('{{ Voyager::image($post->image) }}'); width: 100%; height: 240px; display: block">
    <div class="bg-overlay">
        <div class="bg-overlay-content dark">
            <a href="{{ route('blog.post.index', ['slug' => $post->name_slug]) }}" class="overlay-trigger-icon bg-light text-dark"><i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="bg-overlay-bg dark"></div>
    </div>
</div>
<h4 class=" title-card-blog-{{ $color }} title-card-blog mt-2"><a href="{{ route('blog.post.index', ['slug' => $post->name_slug]) }}">{{ $post->name }}</a></h4>
@if(isset($viewDescription) && $viewDescription == true)
    <p><?php echo substr(strip_tags($post->description),0 , 150)."..."; ?></p>
@endif

