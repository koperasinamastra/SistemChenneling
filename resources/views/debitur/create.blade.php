@extends('adminlte::page')

@section('title', 'Data Debitur')

@section('content_header')
    <h1 class="m-0 text-dark">Data Debitur</h1>
@stop
@push('css')
    <link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/smart_wizard.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/smart_wizard_theme_arrows.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endpush

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="addForm" method="post" action="{{ route('submitImage') }}" enctype="multipart/form-data">
                        <div id="smartwizard">
                            <ul>
                                <li><a href="#step-1">Step 1<br /><small>Info Akun</small></a></li>
                                <li><a href="#step-2">Step 2<br /><small>Data Diri</small></a></li>
                                <li><a href="#step-3">Step 3<br /><small>Upload Dokumen</small></a></li>
                                <li><a href="#step-4">Step 4<br /><small>Kirim Data</small></a></li>
                            </ul>

                            <div class="mt-4">
                                <div id="step-1">
                                    <div class="row">
                                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="Name"
                                                name="name" id="name">
                                        </div>
                                        <div class="col-md-6"> <input type="text" class="form-control"
                                                placeholder="Email" name="email" id="email">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6"> <input type="password" class="form-control"
                                                placeholder="Password" name="password" id="password">
                                        </div>
                                        <div class="col-md-6"> <input type="text" class="form-control"
                                                placeholder="Repeat password" id="confirmed" id="confirmed"> </div>
                                    </div>
                                </div>
                                <div id="step-2">

                                    <div class="row">
                                        <div class="col-md-6"> <input type="text" class="form-control"
                                                placeholder="Nomor KTP" name="noktp" id="noktp">
                                        </div>
                                        <div class="col-md-6"> <input type="text" class="form-control"
                                                placeholder="Nama Debitur" name="nama_debitur" id="nama_debitur">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6"> <input type="text" class="form-control"
                                                placeholder="Alamat" name="alamat" id="alamat">
                                        </div>
                                        <div class="col-md-6"> <input type="text" class="form-control"
                                                placeholder="Nomor Telepon" name="tlp" id="tlp">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6"> <input type="text" class="form-control"
                                                placeholder="Pengajuan Pinjaman (plafond)" name="plafond" id="plafond">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="form-control select2" name="cabang_id" id="cabang_id"
                                                    style="width: 100%;">
                                                    <option>--Pilih Kantor Namastra--</option>
                                                    @foreach ($cabang as $cabang)
                                                        <option value="{{ $cabang->id }}">{{ $cabang->NamaCabang }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-3" class="">
                                    <div class="row">
                                        <div class="col-md-12"><b>Upload KTP Debitur</b> <input type="file"
                                                class="filepond" name="image" id="image" multiple>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-4" class="">
                                    <div class="row justify-content-center mb-3">
                                        <div class="alert alert-danger print-error-msg" style="display:none">
                                            <ul></ul>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center" style="align-content: center">
                                        <button type="submit" id='saveBtn' class="btn btn-primary btn-lg">Kirim
                                            Dokumen</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@stop

@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.smartWizard.min.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
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

        $(document).ready(function() {

            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'arrows',
                autoAdjustHeight: true,
                transitionEffect: 'fade',
                showStepURLhash: false,

            });

        });
    </script>
    <script>
        // Register the plugin
        FilePond.registerPlugin(FilePondPluginImagePreview);

        //configuration filepond
        const inputElement = document.querySelector('input[id="image"]');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement);

        //tujuan filepond
        FilePond.setOptions({
            server: {
                process: '{{ route('upload') }}', //upload
                revert: '{{ route('hapus') }}', //cancel
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });
        //end config filepond

        $(document).ready(function() {
            $("#addForm").on('submit', function(e) {
                e.preventDefault();
                $("#saveBtn").html('Processing...').attr('disabled', 'disabled');
                var link = $("#addForm").attr('action');
                $.ajax({
                    url: link,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("#saveBtn").html('Save').removeAttr('disabled');
                        pond.removeFiles(); //clear
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                    error: function(response) {
                        $("#saveBtn").html('Save').removeAttr('disabled');
                        printErrorMsg(response.error);
                    }
                });
            });

            function printErrorMsg(massage) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(massage, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }

        });
    </script>
@endpush
