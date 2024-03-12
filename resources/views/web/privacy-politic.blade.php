@extends('web/layouts/master')

@section('styles')
@endsection

@section('content')
    <section>
        <div class="container" style="margin-top: 140px">
            <div class="row">
                <div class="col-12">
                    @include('web.partials.texto-politica-privacidad')
                </div>
            </div>
        </div>
    </section>
@endsection
