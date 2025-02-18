<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <th>ID DETAIL</th>
                <th>PENJUALAN</th>
                <th>PRODUK</th>
                <th>JUMLAH PRODUK</th>
                <th>SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detailpenjualans as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ optional($detail->penjualan)->pelanggan->nama_pelanggan ?? 'Pelanggan Tidak Ditemukan' }}</td>
                    <td>{{ optional($detail->produk)->nama_produk ?? 'Produk Tidak Ditemukan' }}</td>
                    <td>{{ $detail->jumlah_produk }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>