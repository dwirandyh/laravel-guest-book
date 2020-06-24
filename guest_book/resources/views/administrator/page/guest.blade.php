@extends('administrator/layout/app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Halaman Buku Tamu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Buku Tamu</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $stat['today'] }}</h3>
                            <p>Tamu Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $stat['total'] }}</h3>
                            <p>Total Tamu</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Buku Tamu</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <a href="#" class="btn btn-sm btn-primary"> Cetak Laporan </a>
                        <a href="#" class="btn btn-sm btn-secondary"> Unduh Excel</a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div>
                            <form class="form-inline">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Import Excel</label>
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="file" id="customControlInline">
                                </div>
                                <button type="submit" class="btn btn-danger my-1">Import</button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th colspan="2">Identitas</th>
                            <th>Nama Tamu</th>
                            <th>Email</th>
                            <th>Instansi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $guest)
                        @php
                        $date = date_create($guest->created_at);
                        @endphp
                        <tr>
                            <td>{{ $guest->id }}</td>
                            <td>{{ date_format($date, 'd/m/yy') }}</td>
                            <td>{{ date_format($date, 'G:i:s') }}</td>
                            <td>
                                {{ $guest->identity }}
                            </td>
                            <td>
                                <a href="{{ asset('/img/identity/' . $guest->identity_file) }}" target="_blank"
                                    class="btn btn-sm btn-primary active">
                                    Unduh Identitas
                                </a>
                            </td>
                            <td>{{ $guest->name }}</td>
                            <td>{{ $guest->email }}</td>
                            <td>{{ $guest->company }}</td>
                            <td><a href="{{ url('/guest/delete/' . $guest->id) }}" class="btn btn-danger active">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
