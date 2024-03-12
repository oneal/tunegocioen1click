<div class="col-md-4 col-sm-12 col-12">
    @if(isset($positions['a']))
        @if(isset($positions['a']->website))<a href="{{ $positions['a']->website }}" target="_blank" title="{{ $positions['a']->name }}">@endif
            <div style="background-size: cover; background-position: center; background-image:url('{{ Voyager::image($positions['a']->image) }}')" title="{{$positions['a']->name}}" alt="{{$positions['a']->name}}" class=" img-letter-position mb-sm-3 mb-3"></div>
        @if(isset($positions['a']->website))</a>@endif
    @else
        <div class="mb-sm-3 mb-3 img-letter-position-void"></div>
    @endif
</div>
<div class="col-md-4 col-sm-12 col-12">
    @if(isset($positions['b']))
        @if(isset($positions['b']->website))<a href="{{ $positions['b']->website }}" target="_blank" title="{{ $positions['b']->name }}">@endif
            <div style="background-size: cover; background-position: center; background-image:url('{{ Voyager::image($positions['b']->image)}}')"  class="mb-sm-3 img-letter-position mb-3"></div>
        @if(isset($positions['b']->website))</a>@endif
    @else
        <div class="mb-sm-3 mb-3 img-letter-position-void"></div>
    @endif
</div>
<div class="col-md-4 col-sm-12 col-12">
    @if(isset($positions['c']))
        @if(isset($positions['c']->website))<a href="{{ $positions['c']->website }}" target="_blank" title="{{ $positions['c']->name }}">@endif
            <div style="background-size: cover; background-position: center; background-image:url('{{ Voyager::image($positions['c']->image)}}')"  class=" img-letter-position mb-sm-3 mb-3"></div>
        @if(isset($positions['c']->website))</a>@endif
    @else
        <div class="mb-sm-3 mb-3 img-letter-position-void"></div>
    @endif
</div>
