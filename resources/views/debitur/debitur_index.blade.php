@extends('adminlte::page')

@section('title', 'Namastra|Data Debitur ')

@section('content_header')
    <h1 class="m-0 text-dark">Manage Data Debitur</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Button trigger modal -->
                    <a class="btn btn-info" href="{{ route('debitur.create') }}" id="createNewDebitur"><i
                            class="fa fa-plus-circle"> Tambah
                            Debitur</i></a>
                    <div class="table-responsive">
                        <table class="table table-hover table-stripped data-table" name="tabeldebitur" id="tabeldebitur">
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="debiturForm" name="debiturForm" class="form-horizontal">
                        <input type="hidden" name="debitur_id" id="debitur_id">
                    </form>
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
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*Render DataTable*/

            var table = $('#tabeldebitur').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('debitur.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_debitur',
                        name: 'nama_debitur'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'tlp',
                        name: 'tlp'
                    },
                    {
                        data: 'plafond',
                        name: 'plafond'
                    },
                    {
                        data: 'cabang_id',
                        name: 'cabang_id'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        $('body').on('click', '.deleteDebitur', function() {
            let debitur_id = $(this).data('id');
            let token = $('meta[name="csrf-token"]').attr('content');

            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "ingin menghapus data ini!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'TIDAK',
                confirmButtonText: 'YA, HAPUS!'
            }).then((result) => {
                if (result.isConfirmed) {

                    //fetch to delete data
                    $.ajax({
                        url: `/debitur/${debitur_id}`,
                        type: "DELETE",
                        cache: false,
                        data: {
                            "_token": token
                        },
                        success: function(response) {
                            window.$('#tabeldebitur').DataTable().ajax.reload();
                            //show success message
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: `${response.message}`,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            //remove post on table
                            $(`#index_${debitur_id}`).remove();
                        }
                    });
                }
            })
        })
    </script>
@endpush
