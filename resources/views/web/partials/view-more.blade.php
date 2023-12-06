<div id="list-qview{{$position->code}}" class="list-qview list-qview{{$position->code}}">
    <div class="eve-box">
        <div>
            <span class="clo-list"><i class="fa-solid fa-xmark"></i></span>
            @if(isset($position->image))
                <img src="{{ Voyager::image($position->image)}}" title="{{ $position->name }}" alt="{{ $position->name }}">
            @endif
        </div>
        <div class="data-list-qview">
            <h4>
                {{ $position->name }}
            </h4>
            <hr/>
            <p class="datos-bussiness">
                @if(isset($position->address))
                    <i class="fa-regular fa-map"></i><span class="addr">{{$position->address}} @if(isset($position->province)), {{$position->province->name}}@endif</span><br/>
                @endif
                @if(isset($position->phone))
                    <i class="fa-solid fa-phone"></i> <span class="pho">{{$position->phone}}</span><br/>
                @endif
                @if(isset($position->email))
                    <i class="fa-solid fa-envelope"></i> <span class="mail">{{ $position->email }}</span><br/>
                @endif
                @if(isset($position->website))
                    <i class="fa-solid fa-globe"></i> <span><a class="link-web-site" target="_blank" href="{{ $position->website }}"> {{$position->website}}</a></span>
                @endif
            </p>
            <hr/>
            <div class="com abo">
                <p><?php echo stripslashes($position->description); ?></p>
            </div>
        </div>
    </div>

</div>
