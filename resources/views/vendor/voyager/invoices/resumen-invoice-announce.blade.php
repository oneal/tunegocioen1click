@extends('voyager::master')

@section('page_title', 'Listado posiciones home')

@section('style')
    <style>
        #file_loader img{
            margin-top: 303px !important;
        }
    </style>
@endsection

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-list"></i> Resumen factura
            <a href="#" id="create-invoice" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> <span>Crear factura</span>
            </a>
        </h1>
    </div>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <!-- form start -->
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Datos empresa</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                        <p>{{ $infoClient['name'] }}<br/>
                            {{ $infoClient['address'] }}<br/>
                            {{ $infoClient['province'] }}<br/>
                            {{ $infoClient['phone'] }}<br/>
                            {{ $infoClient['email'] }}</p>
                    </div><!-- panel-body -->
                    <hr style="margin:0;">
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Fechas</h3>
                        <div class="row" style="margin-right: 4px; margin-left: 4px;">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="name">Fecha inicio</label>
                                <input type="date" class="form-control" id="date_start" name="date_start" placeholder="Fecha inicio" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label" for="name">Fecha fin</label>
                                <input type="date" class="form-control" id="date_end" name="date_end" placeholder="Fecha fin" value="">
                            </div>
                            <input type="hidden" id="num_days" value="0">
                            <input type="hidden" id="type" value="{{ $type }}">
                        </div>
                    </div>
                    <hr style="margin:0;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Concepto</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Días</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Pago anuncio</td>
                                <td><span id="price">{{ $price }}</span>€</td>
                                <td><span id="days">0</span></td>
                                <td><span id="total">0</span>€</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="fileloader" id="file_loader" v-if="is_loading">
            <img src="{{ url('/admin/voyager-assets?path=images%2Flogo-icon.png') }}" alt="Voyager Loader">
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        $('#file_loader').css('display', 'none');
        $('#file_loader').css('padding-top', '350px');
        $(document).on('change','#date_star, #date_end', function() {
            var date_start = $('#date_start').val();
            var date_end = $('#date_end').val();

            if(date_start !== "" && date_end !== "") {
                var fecha_Start = new Date(date_start);
                var fecha_end = new Date(date_end)

                var resta = fecha_end.getTime() - fecha_Start.getTime();
                var num_days = resta / (1000 * 60 * 60 * 24)
                $('#num_days').val(num_days);
                $('#days').html(num_days);
                var price = parseInt($('#price').html());
                $('#total').html(price*num_days)
            }
        });

        $('#create-invoice').on('click', function (){
            $('#file_loader').css('display', 'block');
            var type = $('#type').val();
            var num_days = $('#num_days').val();
            var date_start = $('#date_start').val();
            var date_end = $('#date_end').val();
            if(date_start!=="" && date_end!="") {
                $.ajax({
                    type: "POST",
                    url: "{{ route($route, ['id' => $id]) }}",
                    data: {
                        num_days: num_days,
                        date_start: date_start,
                        date_end: date_end
                    },
                    success: function (data) {
                        if(type == 1) {
                            window.location.href = "{{ route("voyager.homes.index") }}"
                        } else if(type == 2) {
                            window.location.href = "{{ route("voyager.hotels.index") }}"
                        } else if(type == 3) {
                            window.location.href = "{{ route("voyager.professionals.index") }}"
                        } else if(type == 4) {
                            window.location.href = "{{ route("voyager.restaurants.index") }}"
                        } else if(type == 5) {
                            window.location.href = "{{ route("voyager.stores.index") }}"
                        } else if(type == 6) {
                            window.location.href = "{{ route("voyager.work-offers.index") }}"
                        } else if(type == 7) {
                            window.location.href = "{{ route("voyager.blogs-ads.index") }}"
                        }
                    }
                });
            } else {
                $('#file_loader').css('display', 'none');
                alert("Debes seleccionar una fecha de inicio y una de fin")
            }

        })
    </script>
@endsection




