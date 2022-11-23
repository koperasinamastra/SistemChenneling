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
@endpush

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="smartwizard">
                        <ul>
                            <li><a href="#step-1">Step 1<br /><small>Account Info</small></a></li>
                            <li><a href="#step-2">Step 2<br /><small>Personal Info</small></a></li>
                            <li><a href="#step-3">Step 3<br /><small>Payment Info</small></a></li>
                            <li><a href="#step-4">Step 4<br /><small>Confirm details</small></a></li>
                            <li><a href="#step-5">Step 5<br /><small>Confirm details</small></a></li>
                        </ul>
                        <div class="mt-4">
                            <div id="step-1">
                                <div class="row">
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="Name"
                                            required>
                                    </div>
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="Email"
                                            required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="Password"
                                            required>
                                    </div>
                                    <div class="col-md-6"> <input type="text" class="form-control"
                                            placeholder="Repeat password" required> </div>
                                </div>
                            </div>
                            <div id="step-2">
                                <div class="row">
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="Address"
                                            required>
                                    </div>
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="City"
                                            required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="State"
                                            required>
                                    </div>
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="Country"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div id="step-3" class="">
                                <div class="row">
                                    <div class="col-md-6"> <input type="text" class="form-control"
                                            placeholder="Card Number" required>
                                    </div>
                                    <div class="col-md-6"> <input type="text" class="form-control"
                                            placeholder="Card Holder Name" required> </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="CVV"
                                            required> </div>
                                    <div class="col-md-6"> <input type="text" class="form-control"
                                            placeholder="Mobile Number" required>
                                    </div>
                                </div>
                            </div>
                            <div id="step-4" class="">
                                <div class="row">
                                    <div class="col-4">
                                        <input type="file" class="filepond">
                                    </div>
                                </div>
                            </div>
                            <div id="step-5" class="">
                                <div class="row">
                                    <div class="col-md-6"><b>Upload Foto Debitur</b> <input type="file" class="filepond">
                                    </div>
                                    <div class="col-md-6">Upload Foto Debitur<input type="file" class="filepond"></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">Upload Foto Debitur<input type="file" class="filepond"> </div>
                                    <div class="col-md-6">Upload Foto Debitur<input type="file" class="filepond"> </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">Upload Foto Debitur<input type="file" class="filepond">
                                    </div>
                                    <div class="col-md-6">Upload Foto Debitur<input type="file" class="filepond">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">Upload Foto Debitur<input type="file" class="filepond">
                                    </div>
                                    <div class="col-md-6">Upload Foto Debitur<input type="file" class="filepond">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">Upload Foto Debitur<input type="file" class="filepond">
                                    </div>
                                    <div class="col-md-6">Upload Foto Debitur<input type="file" class="filepond">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">Upload Foto Debitur<input type="file" class="filepond">
                                    </div>
                                    <div class="col-md-6">Upload Foto Debitur<input type="file" class="filepond">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">Upload Foto Debitur<input type="file" class="filepond">
                                    </div>
                                    <div class="col-md-6">Upload Foto Debitur<input type="file" class="filepond">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.smartWizard.min.js">
    </script>
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
        FilePond.parse(document.body);
    </script>
@endpush
