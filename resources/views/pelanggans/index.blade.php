@extends('layout.main')
@section('content')
<style>
    .pelanggan-title {
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

<h2 class="pelanggan-title">Pelanggan</h2>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
            <button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#tambahPelangganModal">
                TAMBAH PELANGGAN
            </button>
            <div class="input-group w-25">
                <input type="text" id="searchPelanggan" class="form-control" placeholder="Cari Pelanggan...">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
            </div>
        </div>
        <table class="table table-bordered" id="pelangganTable">
                        <thead>
                            <tr>
                                <th scope="col">ID PELANGGAN</th>
                                <th scope="col">NAMA PELANGGAN</th>
                                <th scope="col">ALAMAT</th>
                                <th scope="col">NO TELPON</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pelanggans as $pelanggan)
                                <tr>
                                    <td>{{ $pelanggan->id_pelanggan }}</td>
                                    <td>{{ $pelanggan->nama_pelanggan }}</td>
                                    <td>{{ $pelanggan->alamat }}</td>
                                    <td>{{ $pelanggan->no_telpon }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pelanggans.destroy', $pelanggan->id_pelanggan) }}" method="POST">
                                            <a href="{{ route('pelanggans.edit', $pelanggan->id_pelanggan) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-danger">Data Pelanggan Belum Tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>  
                    {{ $pelanggans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pelanggan -->
<div class="modal fade" id="tambahPelangganModal" tabindex="-1" aria-labelledby="tambahPelangganModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPelangganModalLabel">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pelanggans.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="id_pelanggan">ID Pelanggan</label>
                        <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_pelanggan">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_telpon">No Telpon</label>
                        <input type="text" class="form-control" id="no_telpon" name="no_telpon" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
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

    $(document).ready(function(){
        $('#searchPelanggan').on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#pelangganTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>
@endsection
