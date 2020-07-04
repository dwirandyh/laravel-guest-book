<!DOCTYPE html>
<html>

<head>
    <title>Laporan Buku Tamu - Personal</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 14px;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        table thead tr th {
            background-color: #F1F1F1
        }
    </style>
</head>

<body>
    <h2>Laporan Buku Tamu - Personal</h2>
    <p>Periode {{ $from }} sampai {{ $to }}</p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Checkin</th>
                <th>Checkout</th>
                <th colspan="2">Identitas</th>
                <th>Nama Tamu</th>
                <th>Email</th>
                <th>Pihak yang dituju</th>
                <th>Keperluan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $guest)
            @php
            $date = date_create($guest->created_at);
            $checkout = date_create($guest->checkout);
            @endphp
            <tr>
                <td>{{ $guest->id }}</td>
                <td>{{ date_format($date, 'd/m/yy G:i:s') }}</td>
                <td>{{ date_format($checkout, 'd/m/yy G:i:s') }}</td>
                <td>
                    {{ $guest->identity }}
                </td>
                <td>
                    {{ $guest->identity_id }}
                </td>
                <td>{{ $guest->name }}</td>
                <td>{{ $guest->email }}</td>
                <td>{{ $guest->intended_person }}</td>
                <td>{{ $guest->purpose }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
