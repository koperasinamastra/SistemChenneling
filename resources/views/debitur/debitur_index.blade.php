@extends('adminlte::page')

@section('title', 'Data Debitur')

@section('content_header')
    <h1 class="m-0 text-dark">Data Debitur</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('debitur.create') }}" class="btn btn-primary mb-2">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                    </a>
                    <div class="table-responsive-sm">
                        <table class="table table-hover table-stripped" id="example2">
                            <thead>
                                <tr class="table-info">
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Plafond</th>
                                    <th>Cabang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($debitur as $key => $row)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $row->nama_debitur }}</td>
                                        <td>{{ $row->alamat }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->tlp }}</td>
                                        <td>{{ $row->plafond }}</td>
                                        <td>{{ $row->cabang->NamaCabang }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="notificationBeforeDelete(event, this)"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <a href="#" onclick="notificationBeforeDelete(event, this)"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    <script>
        $('#example2').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)')
        })


        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }
    </script>
@endpush
