@if(isset($elementsPosition))
    @foreach($elementsPosition as $elementPosition)
        <option value="{{$elementPosition->id}}" @if(isset($positionSelected) && $positionSelected->id == $elementPosition->id) selected @endif>{{$elementPosition->name}}</option>
    @endforeach
@endif
