@extends('adminlte::page')

@section('title', 'Namastra | Data Mitra ')

@section('content_header')
    <h1 class="m-0 text-dark">Manage Data Mitra</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Button trigger modal -->
                    <a class="btn btn-info" href="javascript:void(0)" id="createNewMitra"><i class="fa fa-plus-circle"> Tambah
                            Mitra</i></a>
                    <div class="table-responsive">
                        <table class="table table-hover table-stripped data-table" name="tabelmitra" id="tabelmitra">
                            <thead>
                                <tr class="table-info">
                                    <th>No.</th>
                                    <th>Nama Mitra</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
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
                    <form id="mitraForm" name="mitraForm" class="form-horizontal">
                        <input type="hidden" name="mitra_id" id="mitra_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Name Mitra</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="NamaMitra" name="NamaMitra"
                                    placeholder="Enter Name" value="" maxlength="50" required="">
                                <div class="invalid-feedback d-none" role="alert" id="alert-NamaMitra"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Nomor Telepon</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="tlp" name="tlp"
                                    placeholder="Enter Nomor Telepon" value="" maxlength="50" required="">
                                <div class="invalid-feedback d-none" role="alert" id="alert-tlp"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-12">
                                <textarea id="Alamat" name="Alamat" required="" placeholder="Enter alamat" class="form-control"></textarea>
                                <div class="invalid-feedback d-none" role="alert" id="alert-Alamat"></div>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Simpan
                            </button>
                        </div>
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
        function tampil_data_barang() {
            var table = $('#tabelmitra').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mitra.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'NamaMitra',
                        name: 'NamaMitra'
                    },
                    {
                        data: 'Alamat',
                        name: 'Alamat'
                    },
                    {
                        data: 'tlp',
                        name: 'tlp'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


        }

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            tampil_data_barang()

            $('#createNewMitra').click(function() {
                $('#saveBtn').val("create-mitra");
                $('#mitra_id').val('');
                $('#mitraForm').trigger("reset");
                $('#modelHeading').html("Form Mitra Baru");
                $('#ajaxModel').modal('show');
            });

        });

        /*------------------------------------------
        --------------------------------------------
        Create Product Code
        --------------------------------------------
        --------------------------------------------*/
        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#mitraForm').serialize(),
                url: "{{ route('mitra.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(response) {

                    //show success message
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#mitraForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    window.$('#tabelmitra').DataTable().ajax.reload();
                    table.draw();

                },
                error: function(error) {

                    if (error.responseJSON.NamaMitra[0]) {

                        //show alert
                        $('#alert-NamaMitra').removeClass('d-none');
                        $('#alert-NamaMitra').addClass('d-block');

                        //add message to alert
                        $('#alert-NamaMitra').html(error.responseJSON.NamaMitra[0]);
                    }
                    if (error.responseJSON.tlp[0]) {

                        //show alert
                        $('#alert-tlp').removeClass('d-none');
                        $('#alert-tlp').addClass('d-block');

                        //add message to alert
                        $('#alert-tlp').html(error.responseJSON.tlp[0]);
                    }
                    if (error.responseJSON.Alamat[0]) {

                        //show alert
                        $('#alert-Alamat').removeClass('d-none');
                        $('#alert-Alamat').addClass('d-block');

                        //add message to alert
                        $('#alert-Alamat').html(error.responseJSON.tlp[0]);
                    }
                    $('#saveBtn').html('Save Changes');
                }
            });
        });


        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.editMitra', function() {
            var mitra_id = $(this).data('id');
            $.get("{{ route('mitra.index') }}" + '/' + mitra_id + '/edit', function(data) {
                $('#modelHeading').html("Edit Mitra");
                $('#saveBtn').val("edit-mitra");
                $('#ajaxModel').modal('show');
                $('#mitra_id').val(data.id);
                $('#NamaMitra').val(data.NamaMitra);
                $('#tlp').val(data.tlp);
                $('#Alamat').val(data.Alamat);
            })
        });

        //button Delete post event
        $('body').on('click', '.deleteMitra', function() {

            let mitra_id = $(this).data('id');
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

                        url: `/mitra/${mitra_id}`,
                        type: "DELETE",
                        cache: false,
                        data: {
                            "_token": token
                        },
                        success: function(response) {
                            window.$('#tabelmitra').DataTable().ajax.reload();
                            //show success message
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: `${response.message}`,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            //remove post on table
                            $(`#index_${mitra_id}`).remove();
                        }
                    });
                }
            })
        });
    </script>
@endpush
