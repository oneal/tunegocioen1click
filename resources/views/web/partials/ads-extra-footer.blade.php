<div class="col-lg-6 col-md-12 col-sm-12 col-12">
    @if(isset($positions['e']))
        <a href="{{ $positions['e']->website }}" target="_blank" title="{{ $positions['e']->name }}"><div style="background-size: cover; background-position: center; background-image:url('{{Voyager::image($positions['e']->image)}}')" class="img-letter-position mb-sm-3 mb-3"></div></a>
    @else
        <div class="img-letter-position-void mb-sm-3 mb-3"></div>
    @endif
</div>
<div class="col-lg-6 col-md-12 col-sm-12 col-12">
    @if(isset($positions['f']))
        <a href="{{ $positions['f']->website }}" target="_blank" title="{{ $positions['f']->name }}"><div style="background-size: cover; background-position: center; background-image:url('{{Voyager::image($positions['f']->image)}}')" class="img-letter-position mb-sm-3 mb-3"></div></a>
    @else
        <div class="img-letter-position-void mb-sm-3 mb-3"></div>
    @endif
</div>
