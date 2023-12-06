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
                    <form role="form"
                          class="form-edit-add"
                          action="{{ route('duplicate.create') }}"
                          method="POST" enctype="multipart/form-data">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
