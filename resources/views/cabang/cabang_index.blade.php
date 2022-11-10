@extends('adminlte::page')

@section('title', 'Namastra | Data Cabang ')

@section('content_header')
    <h1 class="m-0 text-dark">Manage Data Cabang</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
             <div class="card">
                <div class="card-body">
                    <!-- Button trigger modal -->
                    <a class="btn btn-info" href="javascript:void(0)" id="createNewCabang"><i class="fa fa-plus-circle"> Tambah Mitra</i></a>
                    <div class="table-responsive">
                        <table class="table table-hover table-stripped data-table" name="tabelcabang" id="tabelcabang">
                        <thead>
                        <tr class="table-info">
                            <th>No.</th>
                            <th>Nama Cabang</th>
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
                    <form id="cabangForm" name="cabangForm" class="form-horizontal">
                       <input type="hidden" name="cabang_id" id="cabang_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Name cabang</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="NamaCabang" name="NamaCabang" placeholder="Masukan nama cabang" value="" maxlength="50" required="">
                                <div class="invalid-feedback d-none" role="alert" id="alert-NamaCabang"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Nomor Telepon</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="tlp" name="tlp" placeholder="Enter nomor Telepon" value="" maxlength="50" required="">
                                <div class="invalid-feedback d-none" role="alert" id="alert-tlp"></div>
                            </div>
                        </div>           
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-12">
                                <textarea id="alamatCabang" name="alamatCabang" required="" placeholder="Enter alamat" class="form-control"></textarea>
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
      $(function () {
      
      /*------------------------------------------
       --------------------------------------------
       Pass Header Token
       --------------------------------------------
       --------------------------------------------*/ 
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
        
      /*------------------------------------------
      --------------------------------------------
      Render DataTable
      --------------------------------------------
      --------------------------------------------*/
      var table = $('#tabelcabang').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('cabang.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'NamaCabang', name: 'NamaCabang'},
              {data: 'alamatCabang', name: 'alamatCabang'},
              {data: 'tlp', name: 'tlp'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

      /*------------------------------------------
    --------------------------------------------
    Click to Button
    --------------------------------------------
    --------------------------------------------*/
    $('#createNewCabang').click(function () {
        $('#saveBtn').val("create-cabang");
        $('#cabang_id').val('');
        $('#cabangForm').trigger("reset");
        $('#modelHeading').html("Form Cabang Baru");
        $('#ajaxModel').modal('show');
    });
         
    });

    /*------------------------------------------
    --------------------------------------------
    Create Product Code
    --------------------------------------------
    --------------------------------------------*/
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
      
        $.ajax({
          data: $('#cabangForm').serialize(),
          url: "{{ route('cabang.store') }}",
          type: "POST",
          dataType: 'json',
          success:function(response){

            //show success message
            Swal.fire({
                type: 'success',
                icon: 'success',
                title: `${response.message}`,
                showConfirmButton: false,
                timer: 1500
            });
              $('#cabangForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              window.$('#tabelcabang').DataTable().ajax.reload();
              table.draw();
           
          },
          error: function (error) {

            if(error.responseJSON.NamaCabang[0]) {

            //show alert
            $('#alert-NamaCabang').removeClass('d-none');
            $('#alert-NamaCabang').addClass('d-block');

            //add message to alert
            $('#alert-NamaCabang').html(error.responseJSON.NamaCabang[0]);
            } 
            if(error.responseJSON.tlp[0]){

            //show alert
            $('#alert-tlp').removeClass('d-none');
            $('#alert-tlp').addClass('d-block');

            //add message to alert
            $('#alert-tlp').html(error.responseJSON.tlp[0]);
            }
            if(error.responseJSON.alamatCabang[0]){

            //show alert
            $('#alert-alamatCabang').removeClass('d-none');
            $('#alert-alamatCabang').addClass('d-block');

            //add message to alert
            $('#alert-alamatCabang').html(error.responseJSON.tlp[0]);
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
    $('body').on('click', '.editCabang', function () {
      var mitra_id = $(this).data('id');
      $.get("{{ route('cabang.index') }}" +'/' + mitra_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Cabang");
          $('#saveBtn').val("edit-cabang");
          $('#ajaxModel').modal('show');
          $('#cabang_id').val(data.id);
          $('#NamaCabang').val(data.NamaCabang);
          $('#tlp').val(data.tlp);
          $('#alamatCabang').val(data.alamatCabang);
      })
    });

 //button create post event
 $('body').on('click', '.deleteCabang', function () {

        let mitra_id = $(this).data('id');
        let token   =$('meta[name="csrf-token"]').attr('content');

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

            url: `/cabang/${cabang_id}`,
            type: "DELETE",
            cache: false,
            data: {
                "_token": token
            },
            success:function(response){ 

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 1500
                });
                window.LaravelDataTables["tabelcabang"].ajax.reload()

                //remove post on table
                $(`#index_${cabang_id}`).remove();
            }
        });
    }
})

});
</script>
@endpush