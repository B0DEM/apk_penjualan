@extends('layout.main')
@section('content')
<style>
    .penjualan-title {
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

<h2 class="penjualan-title">Penjualan</h2>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                        <a href="{{ route('penjualans.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a>
                        <a href="{{ route('generate-laporan-penjualan') }}" class="btn btn-md btn-danger mb-3"><i class="fas fa-file-pdf"></i> CETAK PDF</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">ID PENJUALAN</th>
                                <th scope="col">TANGGAL PENJUALAN</th>
                                <th scope="col">TOTAL HARGA</th>
                                <th scope="col">NAMA PELANGGAN</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
    @forelse ($penjualans as $penjualan)
        <tr>
            <td>{{ $penjualan->id_penjualan }}</td>
            <td>{{ $penjualan->tanggal_penjualan }}</td>
            <td>Rp.{{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
            <td>{{ $penjualan->nama_pelanggan ?? 'Tidak Diketahui' }}</td>
            <td class="text-center">
                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('penjualans.destroy', $penjualan->id_penjualan) }}" method="POST">
                <a href="{{ route('penjualans.show', $penjualan->id_penjualan) }}" class="btn btn-sm btn-info">SHOW</a>
                    <a href="{{ route('penjualans.edit', $penjualan->id_penjualan) }}" class="btn btn-sm btn-primary">EDIT</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                </form>
            </td>
        </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Post belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $penjualans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<script>
    // Notifikasi dengan Toastr
    @if(session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!');
    @elseif(session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!');
    @endif

</script>
@endsection
