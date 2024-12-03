@extends('layouts.main')
@section('title', 'List Data Post')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('button_header')
<a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app" id="btn-create-post">Create</a>
@endsection
@section('judul_header', 'Data Post')

@section('content')

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>DATA PESAN</title>
        
        <style>
            body {
                background-color: lightgray !important;
            }
        </style>

        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js">
        </script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js">
        </script> 
        <script
            src="//cdn.jsdelivr.net/npm/sweetalert2@11">
        </script>
    </head>
        <body>
            <div class="container" style="margin-top: 50px">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-center">DATA PESANAN   </h4>

                        <div class="card border-0 shadow-sm rounded-md mt-4">

                            <div class="card-body">

                                <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-post">TAMBAH</a>

                                <table class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                    <th>Satuan Pesanan</th>
                                    <th>Status Pesanan</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Tanggal Terima</th>
                                    <th>Id Supplier</th>
                                    <th>Id Karyawan</th>
                                    <th>Id Barang</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="table-pesans">
                                    @foreach($pesans as $pesan)
                                    <tr id="index_{{ $pesan->id_pesan }}">
                                        
                                    <td>{{ $pesan->satuan_pesanan }}</td>
                                    <td>{{ $pesan->status_pesanan }}</td>
                                    <td>{{ $pesan->tanggal_pesan }}</td>
                                    <td>{{ $pesan->tanggal_terima }}</td>
                                    <td>{{ $pesan->id_supplier }}</td>
                                    <td>{{ $pesan->id_karyawan }}</td>
                                    <td>{{ $pesan->id_barang }}</td>

                                    
                                    <td class="text-center"> <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $pesan->id_pesan }}" class="btn btn-primary btn-sm">EDIT</a>
                                    
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('pesan.modal-create')
            @include('pesan.modal-update')
            @endsection
@section('js')
    <script src="{{url('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script>
        $('#kt_datatable_example_5').DataTable({
            "language":{
                "lengthMenu": "Show _MENU_",
            },
            "dom":
            "<'row'"+
            "<'col-sm-6 d-flex align-items-center justify-content-start'l"> +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>"+
            ">" +

            "<'table-responsive'tr>"+

            "<'row'"+
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>"+
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>"+
            ">"
        });
    </script>
@endsection
        </body>
</html>
        </body>
</html>