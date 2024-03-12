@if($mobile)
    @if(isset($categories))
        <select id="category-mobile" name="category-mobile" class="form-select mb-2">
            <option value="0">Selecciona una categoría</option>
            @foreach($categories as $category)
                <option value="{{ $category->name_slug }}" @if(isset($categorySelect) && $categorySelect->id == $category->id) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
    @endif
    @if(isset($provincies))
        <select id="provincy-mobile" name="provincy-mobile" class="form-select mb-5">
            <option value="0">Selecciona una provincia</option>
            @foreach($provincies as $provincy)
                <option value="{{ $provincy->name_slug }}" @if(isset($provinceSelect) && $provinceSelect->id == $provincy->id) selected @endif>{{ $provincy->name }}</option>
            @endforeach
        </select>
    @endif
    <div class="d-grid gap-2">
        <button type="button" id="search-mobile" name="search" class="btn button-black btn-block">Buscar</button>
    </div>
@else
    @if(isset($categories))
        <select id="category-desktop" name="category-desktop" class="form-select mb-2">
            <option value="0">Selecciona una categoría</option>
            @foreach($categories as $category)
                <option value="{{ $category->name_slug }}" @if(isset($categorySelect) && $categorySelect->id == $category->id) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
    @endif
    @if(isset($provincies))
        <select id="provincy-desktop" name="provincy-desktop" class="form-select mb-5">
            <option value="0">Selecciona una provincia</option>
            @foreach($provincies as $provincy)
                <option value="{{ $provincy->name_slug }}" @if(isset($provinceSelect) && $provinceSelect->id == $provincy->id) selected @endif>{{ $provincy->name }}</option>
            @endforeach
        </select>
    @endif
    <div class="d-grid gap-2">
        <button type="button" id="search-desktop" name="search-desktop" class="btn button-black btn-block">Buscar</button>
    </div>
@endif
