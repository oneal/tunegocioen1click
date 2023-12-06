<div class="col-sm-3 col-12">
</div>
<div class="col-lg-6 col-md-12 col-sm-12 col-12">
    @if(isset($positions['d']))
        <a href="{{ $positions['d']->website }}" target="_blank" title="{{ $positions['d']->name }}"><div style="background-size: cover; background-position: center; background-image:url('{{Voyager::image($positions['d']->image)}}')" class="img-letter-position mb-sm-3 mb-3"></div></a>
    @else
        <div class="img-letter-position-void"></div>
    @endif
</div>
<div class="col-sm-3 col-12">
</div>
