@extends('layouts.appnew')

@section('css')
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
@endsection

@section('contenedor')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="ibox-tools" style="margin:left;">
            <a href="{{url()->previous() }}">
                <button class="btn btn-warning btn-xs" type="button" style="font-size: 15px;float:right;margin-top:-3%;">
                    <i class="fas fa-arrow-circle-left">
                    </i>
                    Regresar
                </button>
            </a>
        </div>
    </div>
</div>
<div class="content" >
    <div class="row">
         <div class="col-md-12">
              <div class="table-responsive">
                   <table class ="table table-striped" id="dataclientes">
                        <thead>
                            <tr>
                            <th class = "enc_datatable">ID</th>
                            <th class = "enc_datatable">Nombre del Cliente</th>
                            <th class = "enc_datatable">Nit/Cédula</th>
                            <th class = "enc_datatable">Dirección</th>
                            <th class = "enc_datatable">Ciudad</th>
                            <th class = "enc_datatable">Vendedor</th>
                            <th class = "enc_datatable">Latitud</th>
                            <th class = "enc_datatable">Longitud</th>
                            <th class = "enc_datatable">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                          <div id="id_data">
                          @forelse ($clientes as $item)
                            <tr>
                                <td class="campos_datatable" style="width:8%;">{{@$item->clientesID}}</td>
                                <td class="campos_datatable">{{@$item->nombrecompleto}}</td>
                                <td class="campos_datatable">{{@$item->nit}}</td>
                                <td class="campos_datatable">{{@$item->direccion}}</td>
                                <td class="campos_datatable">{{ "ciudad" }}</td>
                                <td class="campos_datatable">{{ "vendedor" }}</td>
                                <td class="campos_datatable">{{@$item->latitud}}</td>
                                <td class="campos_datatable">{{@$item->longitud}}</td>
                                <td style="width:3%;">
                                    <a href="{{ url('clientes/editclientes/' . @$item->id ) }}">
                                    <button class="btn btn-primary btn-xs" type="submit">
                                        Editar
                                    </button>
                                    </a>
                                </td>
                            </tr>
                          @empty
                            <p> No hay Clientes </p>
                          @endforelse
                          </div>
                        </tbody>
                   </table>
              </div>
         </div>
    </div>
</div>
@endsection


@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function()
        {
          $('#dataclientes').DataTable(
            {
                "processing": true,
                "pageLength": 8,
                "language": {
                    "emptyTable":     "No existen datos disponibles en la tabla",
                    "info":           "Mostrando de _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
                    "infoFiltered":   "(filtrado de _MAX_ registros)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Mostrar _MENU_ registros",
                    "loadingRecords": "Cargando...",
                    "processing":     "Procesando...",
                    "search":         "Buscar:",
                    "zeroRecords":    "No existen coincidencias",
                    "paginate": {
                        "first":      "Primero",
                        "last":       "Último",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    },
                    "aria": {
                        "sortAscending":  ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                }
            }
          );
        });
    </script>
@endsection




