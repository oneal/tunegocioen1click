<div class="row">
    <div class="col-sm-4 col-12">
        <select id="category_id" name="category_id" class="form-control">
            <option value="0" @if($category_id == 0){{"selected"}}@endif>Selecciona una categoría</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}" @if($category_id == $category->id){{"selected"}}@endif>{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-4 col-12">
        <select id="province_id" name="province_id" class="form-control">
            <option value="0" @if($province_id == 0){{"selected"}}@endif>Selecciona una provincia</option>
            @foreach($provincies as $provincy)
                <option value="{{$provincy->id}}" @if($province_id == $provincy->id){{"selected"}}@endif>{{$provincy->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-4 col-12">
        <button type="button" class="btn btn-info" onclick="searchPositions()">Buscar</button>
    </div>
</div>
