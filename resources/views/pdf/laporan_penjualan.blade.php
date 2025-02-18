<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            margin: 20px;
            padding: 20px;
        }

        h2 {
            color: #333;
            text-align: center;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }

        p {
            text-align: right;
            font-weight: bold;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h2>{{ $title }}</h2>
    <p>Tanggal: {{ $date }}</p>
    
    <table>
        <thead>
            <tr>
                <th>ID Penjualan</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Penjualan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualans as $penjualan)
            <tr>
                <td>{{ $penjualan->id_penjualan }}</td>
                <td>{{ $penjualan->pelanggan->nama_pelanggan ?? 'Tidak Diketahui' }}</td>
                <td>{{ date('d-m-Y', strtotime($penjualan->tanggal_penjualan)) }}</td>
                <td>Rp {{ number_format($penjualan->total_harga, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
