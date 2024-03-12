<div class="row margin-left-icon">
    @foreach($positions as $position)
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4" style="margin-bottom: 15px;">
            @if(isset($position))
                <div class="dropdown-icon">
                    <a href="javascript:void(0)" attr-home-code="{{ $position->code }}" class="link-icon ms-md-5 ms-sm-2 ms-3 ms-lg-1 img-icon" style="background-size: cover; background-position: center; background-image:url('{{ Voyager::image($position->icon)}}'); width: 80px; height: 80px; display: block;"></a>
                    <ul class="dropdown-menu text-center">
                        @if(isset($position->name))<li>{{$position->name}}</li>@endif
                        @if(isset($position->province))<li>{{$position->province->name}}</li>@endif
                        @if(isset($position->phone))<li>{{$position->phone}}</li>@endif
                        @if(isset($position->email))<li>{{$position->email}}</li>@endif
                        @if(isset($position->website))<li><a class="link-web-site" target="_blank" href="{{ $position->website }}"> {{$position->website}}</a></li>@endif
                    </ul>
                </div>
                @include('web.partials.view-more')
            @else
                <div class="ms-md-5 ms-sm-2 ms-lg-1 ms-3 img-icon-void"></div>
            @endif
        </div>
    @endforeach
</div>
