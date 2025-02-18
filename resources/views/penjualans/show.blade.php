@extends('layout.main')
@section('content') 

<div class="container">
    <h1>Show Penjualan</h1>

    <a href="{{ route('penjualans.index') }}" class="btn btn-secondary mb-3">
        ⬅ Kembali ke Data Penjualan
    </a>

    @if($penjualan->total_harga == 0)
        <div class="alert alert-warning d-flex align-items-center">
            <i class="fas fa-exclamation-triangle me-2"></i> 
            Pelanggan ini belum melakukan transaksi atau total transaksi masih Rp 0.
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Informasi Penjualan</h4>
            <p><strong>Pelanggan:</strong> {{ $penjualan->pelanggan->nama_pelanggan }}</p>
            <p><strong>Tanggal Penjualan:</strong> {{ $penjualan->tanggal_penjualan }}</p>
            <p><strong>Total Harga:</strong>Rp.{{ number_format($penjualan->total_harga, 0, ',', '.') }}</p>
        </div>
    </div>

    <h4 class="mt-4">Detail Produk</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualan->detailpenjualans as $index => $detail)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $detail->produk->nama_produk }}</td>
                <td>{{ $detail->jumlah_produk }}</td>
                <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection