
<div class="col-sm-6 col-12">
    <div class="row">
        @foreach($positions as $key => $position)
            <?php
            $result = statusAnounce($position);
            ?>
            <div class="col-sm-3 col-3">
                <div class="alert <?php echo $result['alert']?>" role="alert">
                    {{ $key }} - <?php echo $result['paid']?>
                    @if(isset($position))
                        <a href="{{ url('/admin/'.$uri.'/'.$position->id.'/edit') }}" class="link-icon ms-md-5 ms-sm-2 ms-3 ms-lg-1 img-icon" style="background-size: cover; background-position: center; background-image:url('{{ Voyager::image($position->icon)}}'); width: 80px; height: 80px; display: block;"></a>
                    @else
                        <div class="ms-md-5 ms-sm-2 ms-lg-1 ms-3 img-icon-void"></div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
