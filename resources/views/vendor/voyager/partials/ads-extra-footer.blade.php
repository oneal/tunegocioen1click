<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
        <?php
        $result = statusAnounce($positions['e']);
        ?>
        <div class="alert <?php echo $result['alert']?>" role="alert">
            e - <?php echo $result['paid']?>
            @if(isset($positions['e']))
                <div style="background-size: cover; background-position: center; background-image:url('{{Voyager::image($positions['e']->image)}}')" class="img-letter-position mb-sm-3 mb-3"></div>
            @else
                <div class="img-letter-position-void mb-sm-3 mb-3"></div>
            @endif
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
        <?php
        $result = statusAnounce($positions['f']);
        ?>
        <div class="alert <?php echo $result['alert'];?>" role="alert">
            f - <?php echo $result['paid']?>
            @if(isset($positions['f']))
                <div style="background-size: cover; background-position: center; background-image:url('{{Voyager::image($positions['f']->image)}}')" class="img-letter-position mb-sm-3 mb-3"></div>
            @else
                <div class="img-letter-position-void mb-sm-3 mb-3"></div>
            @endif
        </div>
    </div>
</div>
