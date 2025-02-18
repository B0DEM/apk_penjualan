@extends('layout.main')
@section('content') 

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-primary text-white">
                    <h5>Detail Penjualan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID Detail</th>
                            <td>{{ $detail->id_detail }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <td>{{ optional($detail->penjualan)->pelanggan->nama_pelanggan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Produk</th>
                            <td>{{ optional($detail->produk)->nama_produk ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Harga Satuan</th>
                            <td>Rp {{ number_format(optional($detail->produk)->harga, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Produk</th>
                            <td>{{ $detail->jumlah_produk }}</td>
                        </tr>
                        <tr>
                            <th>Subtotal</th>
                            <td>Rp {{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Penjualan</th>
                            <td>{{ optional($detail->penjualan)->tanggal_penjualan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status Pembayaran</th>
                            <td>
                                @php
                                    $status = optional($detail->penjualan)->status_pembayaran ?? '';
                                    $badgeColor = match ($status) {
                                        'Lunas' => 'success',
                                        'Belum Lunas' => 'warning',
                                        'Dibatalkan' => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $badgeColor }}" id="statusBadge">{{ $status }}</span>
                                <button id="statusButton" class="btn btn-info mt-2" onclick="changeStatus()">Ubah Status</button>
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('detailpenjualans.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeStatus() {
        // Mengambil elemen status dan tombol
        var statusBadge = document.getElementById("statusBadge");
        var statusButton = document.getElementById("statusButton");

        // Mengecek jika status saat ini "Belum Dikonfirmasi"
        if (statusBadge.innerText === "") {
            // Ubah teks dan warna badge
            statusBadge.classList.remove("bg-secondary");
            statusBadge.classList.add("bg-success");
            // Mengubah tombol menjadi "Lunas"
            statusButton.innerText = "Lunas";
            statusButton.classList.remove("btn-info");
            statusButton.classList.add("btn-success");
        }
    }
</script>



@endsection

