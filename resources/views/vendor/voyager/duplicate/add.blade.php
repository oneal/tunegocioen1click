@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', "Duplicar ficha")

@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        Duplicar ficha
    </h1>
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form id="form-add"
                          action="{{ route('duplicate.addDuplicate') }}"
                          method="POST">
                        @csrf
                        <div class="row" style="margin-left: 0; margin-right: 0">
                            <div class="col-sm-12">
                                <h5>
                                    Origen
                                </h5>
                                <hr/>
                                <div class="mb-3">
                                    <label for="types" class="form-label">Tipo</label>
                                    <select class="form-control" name="types" id="types" onchange="searchDataByType()">
                                        <option value="0">Selecciona una opción</option>
                                        @foreach($types as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="data" class="form-label">Elemento</label>
                                    <select class="form-control" name="data" id="data" >

                                    </select>
                                </div>
                                <h5>
                                    Destino
                                </h5>
                                <hr/>
                                <div class="mb-3">
                                    <label for="d-types" class="form-label">Tipo</label>
                                    <select class="form-control" name="d-types" id="d-types" onchange="searchCategoryByType()" >
                                        <option value="0">Selecciona una opción</option>
                                        @foreach($types as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="d-category" class="form-label">Categoría</label>
                                    <select class="form-control" name="d-category" id="d-category" onchange="searchPositions()">

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="d-province" class="form-label">Provincia</label>
                                    <select class="form-control" name="d-province" id="d-province" onchange="searchPositions()">
                                        <option value="0"></option>
                                        @foreach($provincies as $provincie)
                                            <option value="{{ $provincie->id }}">{{ $provincie->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="d-position" class="form-label">Posición</label>
                                    <select class="form-control" name="d-position" id="d-position" >

                                    </select>
                                </div>
                                <div class="mt-3">
                                    <input type="submit" class="btn btn-primary" value="Envíar"/>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        function searchDataByType() {
            var data = {
                type: $('#types').val()
            }

            $.ajax({
                url : "{{route('duplicate.searchDataByType')}}",
                data : data,
                type : 'GET',
                success : function(result) {
                    $('#data').html(result);
                },
                error : function(xhr, status) {
                    alert('Disculpe, existió un problema');
                }
            });
        }

        function searchCategoryByType() {
            var data = {
                dtype: $('#d-types').val()
            }

            $.ajax({
                url : "{{route('duplicate.searchCategoryByType')}}",
                data : data,
                type : 'GET',
                success : function(result) {
                    $('#d-category').html(result);
                    searchPositions();
                },
                error : function(xhr, status) {
                    alert('Disculpe, existió un problema');
                }
            });
        }

        function searchPositions() {
            var data = {
                dtype: $('#d-types').val(),
                dcategory: $('#d-category').val(),
                dprovince: $('#d-province').val()
            }

            $.ajax({
                url : "{{route('duplicate.searchPositions')}}",
                data : data,
                type : 'GET',
                success : function(result) {
                    $('#d-position').html(result);
                },
                error : function(xhr, status) {
                    alert('Disculpe, existió un problema');
                }
            });
        }
    </script>
@stop
