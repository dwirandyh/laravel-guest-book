<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Form Buku Tamu Instansi</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style>
        .bg {
            /* The image used */
            background-image: url("{{ asset('bpk-building.jpg') }}");

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .title-color {
            color: black
        }
    </style>
</head>

<body class="hold-transition login-page col-sm-12 bg">
    <div class="login-box-2 col-sm-3">
        <div class="login-logo">
            <!-- ================ DISINI GANTI BACKGROUND ================ -->
            <img src="{{ asset('bpk-logo.png') }}" style="height: 100px; width: 100px; margin-top:50px;">
            <div class="title-color"><b>Buku </b>Tamu Instansi</div>
        </div>
        <!-- /.login-logo -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Data Diri Tamu</p>

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif

                    <form method="post" action="{{ url('/company/save') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan nama lengkap"
                                value="{{ old('name') }}">
                            <div class="form-check">
                                <input class="form-check-input" name="is_leader" type="checkbox" value="1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Pempimpin Grup
                                </label>
                            </div>
                            @if($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                placeholder="Masukan email dengan benar" value="{{ old('email') }}">
                            @if($errors->has('email'))
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Identitas</label>
                            <select class="form-control" name="identity" placeholder="Pilih salah satu">
                                <option>KTP</option>
                                <option>SIM</option>
                                <option>Passport</option>
                                <option>Nametag</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Foto Identitas</label>
                                    @if($errors->has('identity_file'))
                                    <div class="text-danger">{{ $errors->first('identity_file') }}</div>
                                    @endif
                                    <div class="col-12">
                                        <div id="camera-result-identity"></div>
                                    </div>
                                    <br>
                                    <input type="hidden" name="identity_file" class="image-field-identity">
                                    <button type="button" onclick="openCameraDialog('identity')"
                                        class="btn btn-primary btn-block">Buka
                                        Kamera</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nomor Identitas</label>
                            <input type="text" name="identity_id" class="form-control"
                                placeholder="Masukan nomor identitas" value="{{ old('identity_id') }}">
                            @if($errors->has('identity_id'))
                            <div class="text-danger">{{ $errors->first('identity_id') }}</div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Foto Wajah</label>
                                    @if($errors->has('photo_file'))
                                    <div class="text-danger">{{ $errors->first('photo_file') }}</div>
                                    @endif
                                    <div class="col-12">
                                        <div id="camera-result-face"></div>
                                    </div>
                                    <br>
                                    <input type="hidden" name="photo_file" class="image-field-face">
                                    <button type="button" onclick="openCameraDialog('face')"
                                        class="btn btn-primary btn-block">Buka
                                        Kamera</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="phone_number" class="form-control"
                                placeholder="Masukan nomor telepon" value="{{ old('phone_number') }}">
                            @if($errors->has('phone_number'))
                            <div class="text-danger">{{ $errors->first('phone_number') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Instansi</label>
                            <input type="text" name="company" class="form-control" placeholder="Masukan nama instansi"
                                value="{{ old('company') }}">
                            @if($errors->has('company'))
                            <div class="text-danger">{{ $errors->first('company') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" name="role" class="form-control" placeholder="Masukan jabatan"
                                value="{{ old('role') }}">
                            @if($errors->has('role'))
                            <div class="text-danger">{{ $errors->first('role') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Pihak Yang Dituju</label>
                            <select class="form-control" name="intended_person" id="intended-person" name="identity"
                                placeholder="Pilih salah satu">
                                <option value="Kepala Perwakilan">Kepala Perwakilan</option>
                                <option value="Kepala Sekretariat Perwakilan">Kepala Sekretariat Perwakilan</option>
                                <option value="Kepala Sub Auditoriat I">Kepala Sub Auditoriat I</option>
                                <option value="Kepala Sub Auditoriat II">Kepala Sub Auditoriat II</option>
                                <option value="">Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group" id="intended-person-name-layout">
                            <label>Nama yang dituju</label>
                            <input type="text" name="intended_person_name" class="form-control"
                                placeholder="Masukan nama yang dituju" value="{{ old('intended_person_name') }}">
                        </div>

                        <div class="form-group">
                            <label>Hubungan</label>
                            <input type="text" name="relation" class="form-control"
                                placeholder="Hubungan dengan pihak yang dituju" value="{{ old('relation') }}">
                            @if($errors->has('relation'))
                            <div class="text-danger">{{ $errors->first('relation') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Keperluan</label>
                            <textarea class="form-control" name="purpose" rows="4"
                                placeholder="Masukan keperluan berkunjung">{{ old('purpose') }}</textarea>
                            @if($errors->has('purpose'))
                            <div class="text-danger">{{ $errors->first('purpose') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Perkiraan Waktu Berkunjung</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    Jam
                                    <select class="form-control" name="estimated_time_hour"
                                        placeholder="Pilih salah satu">
                                        @for ($i = 0; $i < 10; $i++) <option value="{{ $i * 60 }}">{{ $i }} Jam
                                            </option>
                                            @endfor
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    Menit
                                    <select class="form-control" name="estimated_time_minute"
                                        placeholder="Pilih salah satu">
                                        <option value="0">0 Menit</option>
                                        <option value="15" selected>15 Menit</option>
                                        <option value="30">30 Menit</option>
                                        <option value="45">45 Menit</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Simpan Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- Camera Dialog -->
    <div class="modal" tabindex="-1" role="dialog" id="camera-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Kartu Identas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="camera-modal-body">
                    <div id="my_camera" style="display: block;
                    margin-left: auto;
                    margin-right: auto;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="takeScreenshot()">Ambil Gambar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Webcam JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    <script>
        var selectedCamera = "identity";

        $(document).ready(function(){
            let width = $(".login-box-2").width()

            Webcam.set({
                width: width,
                height: width,
                image_format: 'jpeg',
                jpeg_quality: 90,
                flip_horiz: true
            });

            $("#intended-person-name-layout").hide();
        });

        function openCameraDialog(id){
            selectedCamera = id
            Webcam.attach( '#my_camera' );
            $("#camera-modal").modal('show');
        }

        function takeScreenshot(){
            Webcam.snap( function(data_uri) {
                $(".image-field-" + selectedCamera).val(data_uri);
                document.getElementById('camera-result-' + selectedCamera).innerHTML = '<img class="img-thumbnail" src="'+data_uri+'"/>';
            });

            $("#camera-modal").modal('hide');
        }

        $('#camera-modal').on('hidden.bs.modal', function () {
            Webcam.reset()
        });

        $("#intended-person").change(function() {
            let selectedValue = $(this).val()
            if (selectedValue == ''){
                $("#intended-person-name-layout").show();
            } else {
                $("#intended-person-name-layout").hide();
            }
        });
    </script>

    <script>
        document.write(
          '<script src="http://' +
            (location.host || '${1:localhost}').split(':')[0] +
            ':${2:35729}/livereload.js?snipver=1"></' +
            'script>'
        );
    </script>
</body>

</html>
