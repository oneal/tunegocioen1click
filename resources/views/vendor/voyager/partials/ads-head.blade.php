<div class="row">
    <div class="col-md-4 col-sm-12 col-12">
        <?php
            $result = statusAnounce($positions['a']);
        ?>
        <div class="alert <?php echo $result['alert']?>" role="alert">
            a - <?php echo $result['paid']?>
            @if(isset($positions['a']))
                <a href="{{ url('/admin/'.$uri.'/'.$positions['a']->id.'/edit') }}">
                    <div style="background-size: cover; background-position: center; background-image:url('{{ Voyager::image($positions['a']->image) }}')" title="{{$positions['a']->name}}" alt="{{$positions['a']->name}}" class=" img-letter-position mb-sm-3 mb-3"></div>
                </a>
            @else
                <div class="mb-sm-3 mb-3 img-letter-position-void"></div>
            @endif
        </div>
    </div>
    <div class="col-md-4 col-sm-12 col-12">
        <?php
        $result = statusAnounce($positions['b']);
        ?>
        <div class="alert <?php echo $result['alert']?>" role="alert">
            b - <?php echo $result['paid']?>
            @if(isset($positions['b']))
                <a href="{{ url('/admin/'.$uri.'/'.$positions['b']->id.'/edit') }}">
                    <div style="background-size: cover; background-position: center; background-image:url('{{ Voyager::image($positions['b']->image) }}')" title="{{$positions['b']->name}}" alt="{{$positions['b']->name}}" class=" img-letter-position mb-sm-3 mb-3"></div>
                </a>
            @else
                <div class="mb-sm-3 mb-3 img-letter-position-void"></div>
            @endif
        </div>
    </div>
    <div class="col-md-4 col-sm-12 col-12">
        <?php
        $result = statusAnounce($positions['c']);
        ?>
        <div class="alert <?php echo $result['alert']?>" role="alert">
            c - <?php echo $result['paid']?>
            @if(isset($positions['c']))
                <a href="{{ url('/admin/'.$uri.'/'.$positions['c']->id.'/edit') }}">
                    <div style="background-size: cover; background-position: center; background-image:url('{{ Voyager::image($positions['c']->image) }}')" title="{{$positions['c']->name}}" alt="{{$positions['c']->name}}" class=" img-letter-position mb-sm-3 mb-3"></div>
                </a>
            @else
                <div class="mb-sm-3 mb-3 img-letter-position-void"></div>
            @endif
        </div>
    </div>
</div>
