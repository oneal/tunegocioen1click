<div class="row">
    <div class="col-sm-3 col-12">
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
        <?php
        $result = statusAnounce($positions['d']);
        ?>
        <div class="alert <?php echo $result['alert'];?>" role="alert">
            d - <?php echo $result['paid']?>
            @if(isset($positions['d']))
                <a href="{{ url('/admin/'.$uri.'/'.$positions['d']->id.'/edit') }}">
                    <div style="background-size: cover; background-position: center; background-image:url('{{Voyager::image($positions['d']->image)}}')" class="img-letter-position mb-sm-3 mb-3"></div>
                </a>
            @else
                <div class="img-letter-position-void"></div>
            @endif
        </div>
    </div>
    <div class="col-sm-3 col-12">
    </div>
</div>
