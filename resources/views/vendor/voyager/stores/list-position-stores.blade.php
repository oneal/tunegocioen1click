@extends('voyager::master')

@section('page_title', 'Listado posiciones almacenes')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-list"></i> Listado posiciones almacenes
            <a href="{{ url('admin/stores/create') }}" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> <span>Crear</span>
            </a>
        </h1>
    </div>
@stop

@section('content')
    <div class="page-content container-fluid">
        <?php $categories = $storeCategories;?>
        @include('voyager::partials.filterlist', [$categories, $provincies])
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <?php $uri = 'stores';?>
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
                <?php $positions = $positionsLetter;?>
                @include('voyager::partials.ads-extra-footer', [$positions, $uri])
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="application/javascript">
        function searchPositions(){
            var category_id = $('#category_id').val();
            var province_id = $('#province_id').val();

            var url = '{{ route("stores.listPositionStores")}}';

            window.location.href = url+"?category_id="+category_id+"&province_id="+province_id;
        }
    </script>
@stop




