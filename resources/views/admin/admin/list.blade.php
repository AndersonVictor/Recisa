@extends('layouts.app')
@section('title','Usuarios')
    @push('css')
        <!--Alertas-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>            
    @endpush 
    @section('content')
        @if (session('success'))
            <script>
                let message ="{{session('success')}}";
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: message
                });
            </script>            
        @endif   
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Usuarios</h3>
        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{url('admin/admin/add')}}" style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;--bs-body-bg: #00486E;background: #00486E;">
            <i class="fas fa-user fa-sm text-white-50"></i>&nbsp;Crear Usuario
        </a>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Lista de Usuarios</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-nowrap">
                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                <label class="form-label">Filas&nbsp;
                                    <select class="d-inline-block form-select form-select-sm">
                                        <option value="10" selected="">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>&nbsp;
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                        </div>
                    </div>
                    <div class="table-responsive table mt-2" id="dataTable-2" role="grid" aria-describedby="dataTable_info">
                        <table id="" class="table my-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">#</th>
                                    <th style="width: 400px;">Nombre</th>
                                    <th style="width: 300px;">Usuario</th>
                                    <th style="width: 300px;">Email</th>
                                    <th style="width: 150px;">Rol</th>
                                    <th style="width: 200px;">Estado</th>
                                    <th style="width: 200px;">Creación</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $value)
                                    <tr>
                                        <td>1</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->username}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>
                                            @switch($value)
                                                @case($value->user_level == 1)
                                                    Admin
                                                    @break
                                                @case(value->user_level == 2)
                                                    Secretaria
                                                    @break
                                                @case(value->user_level == 3)
                                                    Doctor
                                                    @break    
                                                @default                                                   
                                            @endswitch
                                        </td>
                                        <td>
                                            @if ($value->status == 1)
                                                <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                                            @endif
                                        </td>
                                        <td>{{date('d-m-Y', strtotime($value->created_at))}}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{url('admin/admin/edit/'.$value->id)}}" class="btn btn-primary" style="background: #7BDE7C;"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="{{url('admin/admin/delete/'.$value->id)}}" class="btn btn-danger"style="background: #EB5C5E;"><i class="far fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr></tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">1 a 10 de 27</p>
                        </div>
                        <div class="col-md-6">
                            <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                <ul class="pagination">
                                    <li class="page-item disabled"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                                    <li class="page-item active" style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    @endsection
    @push('js')
    <script>
        $('#usuario').DataTable({
            responsive: true,
            autoWidth:false,

            "language": {
                "lengthMenu": "Mostrar "+
                                `<select class="custom-select custom-select-sm w-25 form-select form-select-sm mb-3">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                </select>`+
                             " registro por página",
                "zeroRecords": "No se encontró nada - lo siento",
                "info": "Mostrar la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate":{
                    "next":"Siguiente",
                    "previous":"Anterior"
                }
            }
        });
    </script>    
    @endpush