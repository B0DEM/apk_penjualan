@extends('layout.main')
@section('content')
<style>
    .detailpenjualan-title {
        margin-left: 20px;
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .container {
        max-width: 95%;
        margin: auto;
    }

    .table {
        width: 100%;
        background-color: #fff;
    }

    .table th {
        background-color: #181824;
        color: white;
        text-align: center;
        padding: 10px;
    }

    .table td {
        text-align: center;
        padding: 10px;
        vertical-align: middle;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }
</style>

<h2 class="detailpenjualan-title">Detailpenjualan</h2>
<div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('detailpenjualans.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DETAILPENJUALAN</a>
                        <a href="{{ route('generate-pdf') }}" class="btn btn-md btn-danger mb-3"><i class="fas fa-file-pdf mr-2"></i>CETAK PDF</a>
                        <table class="table table-bordered">
                        <thead>
                                <tr>
                                    <th scope="col">ID DETAIL</th>
                                    <th scope="col">NAMA PENJUALAN</th>
                                    <th scope="col">NAMA PRODUK</th>
                                    <th scope="col">JUMLAH PRODUK</th>
                                    <th scope="col">SUBTOTAL</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($detailpenjualans as $detail)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ optional($detail->penjualan)->pelanggan->nama_pelanggan ?? 'Pelanggan Tidak Ditemukan' }}</td>
                                        <td>{{ optional($detail->produk)->nama_produk ?? 'Produk Tidak Ditemukan' }}</td>
                                        <td>{{ $detail->jumlah_produk }}</td>
                                        <td>Rp {{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('detailpenjualans.destroy', $detail->id_detail) }}" method="POST">
                                                <a href="{{ route('detailpenjualans.show', $detail->id_detail) }}" class="btn btn-sm btn-info">SHOW</a>
                                                <a href="{{ route('detailpenjualans.edit', $detail->id_detail) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center alert alert-danger">
                                            Data Detail Penjualan belum tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>  
                    </div>
                    
                    <!-- Pagination dengan posisi di ujung kiri -->
                    <div class="d-flex justify-content-start">
                        {{ $detailpenjualans->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<script>
    // Notifikasi dengan Toastr
    @if(session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!');
    @elseif(session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!');
    @endif
</script>
@endsection
