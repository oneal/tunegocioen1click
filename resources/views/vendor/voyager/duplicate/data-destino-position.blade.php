@if(isset($dataPositions))
    @foreach($dataPositions as $d)
        <option value="{{ $d->id }}">{{ $d->name }}</option>
    @endforeach
@endif
