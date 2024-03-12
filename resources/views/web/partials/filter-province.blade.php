@if($mobile)
    @if(isset($provincies))
        <select id="provincy-mobile" name="provincy-mobile" class="form-select mb-5">
            <option value="0">Selecciona una provincia</option>
            @foreach($provincies as $provincy)
                <option value="{{ $provincy->name_slug }}" @if(isset($provinceSelect) && $provinceSelect->id == $provincy->id) selected @endif>{{ $provincy->name }}</option>
            @endforeach
        </select>
    @endif
    <div class="d-grid gap-2">
        <button type="button" id="search-province-mobile" name="search" class="btn button-black btn-block">Buscar</button>
    </div>
@else
    @if(isset($provincies))
        <select id="provincy-desktop" name="provincy-desktop" class="form-select mb-5">
            <option value="0">Selecciona una provincia</option>
            @foreach($provincies as $provincy)
                <option value="{{ $provincy->name_slug }}" @if(isset($provinceSelect) && $provinceSelect->id == $provincy->id) selected @endif>{{ $provincy->name }}</option>
            @endforeach
        </select>
    @endif
    <div class="d-grid gap-2">
        <button type="button" id="search-province-desktop" name="search-desktop" class="btn button-black btn-block">Buscar</button>
    </div>
@endif
