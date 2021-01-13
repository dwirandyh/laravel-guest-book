@extends('administrator/layout/app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Tamu Saat Ini - Personal</h3>

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
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Isi Form</th>
                            <th>Tgl Check In</th>
                            <th>Perkiraan Checkout</th>
                            <th colspan="2">Identitas</th>
                            <th>Nama Tamu</th>
                            <th>Email</th>
                            <th>Keperluan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guest as $data)
                        @php
                        $visitDate = date_create($data->visit_date);
                        $date = date_create($data->created_at);
                        $estimatedCheckout = strtotime('+' . $data->estimated_time . ' minutes',
                        strtotime($data->visit_date));
                        @endphp
                        <tr data-checkout="{{ date('Y-m-d G:i:s', $estimatedCheckout) }}">
                            <td>{{ $data->id }}</td>
                            <td>{{ date_format($date, 'd/m/Y G:i:s') }}</td>
                            <td>{{ date_format($visitDate, 'd/m/Y G:i:s') }}</td>
                            <td>{{ date('d/m/Y G:i:s', $estimatedCheckout) }}</td>
                            <td>
                                {{ $data->identity }}
                            </td>
                            <td>
                                <a href="{{ asset('/img/identity/' . $data->identity_file) }}" target="_blank"
                                    class="btn btn-sm btn-primary active">
                                    Unduh Identitas
                                </a>
                            </td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->purpose }}</td>
                            <td><a href="{{ url('/administrator/guest/checkout/' . $data->id) }}"
                                    class="btn btn-info active">
                                    Checkout
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->


        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Tamu Saat Ini - Instansi</h3>

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
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tgl Check In</th>
                            <th>Perkiraan Checkout</th>
                            <th colspan="2">Identitas</th>
                            <th>Nama Tamu</th>
                            <th>Email</th>
                            <th>Instansi</th>
                            <th>Keperluan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($company as $data)
                        @php
                        $date = date_create($data->created_at);
                        $estimatedCheckout = strtotime('+' . $data->estimated_time . ' minutes',
                        strtotime($data->created_at));
                        @endphp
                        <tr data-checkout="{{ date('Y-m-d G:i:s', $estimatedCheckout) }}">
                            <td>{{ $data->id }}</td>
                            <td>{{ date_format($date, 'd/m/Y G:i:s') }}</td>
                            <td>{{ date('d/m/Y G:i:s', $estimatedCheckout) }}</td>
                            <td>
                                {{ $data->identity }}
                            </td>
                            <td>
                                <a href="{{ asset('/img/identity/' . $data->identity_file) }}" target="_blank"
                                    class="btn btn-sm btn-primary active">
                                    Unduh Identitas
                                </a>
                            </td>
                            <td>{{ $data->name }} <b>{{ ($data->is_leader == 1 ? ' (Ketua)' : '' )}}</b></td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->company }}</td>
                            <td>{{ $data->purpose }}</td>
                            <td><a href="{{ url('/administrator/company/checkout/' . $data->id) }}"
                                    class="btn btn-info active">
                                    Checkout
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('css')
<style>
    .checkout-row {
        background-color: yellow;
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        checkData();
    });

    setInterval(function() {
        checkData()
    }, 3000);

    function checkData(){
        $('tr').each(function(){
            var checkout = $(this).data('checkout');
            if (checkout != null) {
                var checkoutDate = new Date(checkout);
                var currentDate = new Date();
                if (currentDate > checkoutDate) {
                    $(this).find('td').addClass('alert-danger');
                } else {
                    $(this).find('td').removeClass('alert-danger');
                }
            }
        })
    }
</script>
@endsection
