@extends('adminlte::page')

@section('title', 'Data list Pengajuan')

@section('content_header')
    <h1 class="m-0 text-dark">Data List pengajuan Debitur</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

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
