@if(isset($dataCategories))
    <option value="0"></option>
    @foreach($dataCategories as $d)
        <option value="{{ $d->id }}">{{ $d->name }}</option>
    @endforeach
@endif
