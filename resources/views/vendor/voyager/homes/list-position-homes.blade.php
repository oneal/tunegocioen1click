@extends('voyager::master')

@section('page_title', 'Listado posiciones home')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-list"></i> Listado posiciones home
            <a href="{{ url('admin/homes/create') }}" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> <span>Crear</span>
            </a>
        </h1>
    </div>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php $uri = 'homes';?>
                <?php $positions = $positionsLetter;?>
                @include('voyager::partials.ads-head', [$positions, $uri])
                <div class="row">
                    <?php $positions = $positions20;?>
                    @include('voyager::partials.icons-position', [$positions, $uri])
                    <?php $positions = $positionsOther20;?>
                    @include('voyager::partials.icons-position', [$positions, $uri])
                </div>
                <?php $positions = $positionsLetter;?>
                @include('voyager::partials.ads-footer', [$positions, $uri])
            </div>
        </div>
    </div>
@stop




