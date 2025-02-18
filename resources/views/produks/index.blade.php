@extends('layout.main')
@section('content')
<style>
    .produk-title {
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

<h2 class="produk-title">Produk</h2>
<div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                    <button class="btn btn-md btn-success mb-3" data-toggle="modal" data-target="#tambahProdukModal">TAMBAH PRODUK</button>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">ID PRODUK</th>
                                <th scope="col">NAMA PRODUK</th>
                                <th scope="col">HARGA</th>
                                <th scope="col">STOK</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                @forelse ($produks as $produk)
                    <tr>
                        <td>{{ $produk->id_produk }}</td>
                        <td>{{ $produk->nama_produk }}</td>
                        <td>Rp {{ number_format($produk->harga, 2, ',', '.') }}</td>
                        <td>{{ $produk->stok }}</td>
                        <td class="text-center">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('produks.destroy', $produk->id_produk) }}" method="POST">
                                <a href="{{ route('produks.edit', $produk->id_produk) }}" class="btn btn-sm btn-primary">EDIT</a>
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
                          {{ $produks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahProdukModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('produks.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold">ID Produk</label>
                        <input type="text" name="id_produk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Harga</label>
                        <input type="number" name="harga" class="form-control"  required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Stok</label>
                        <input type="number" name="stok" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                    <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">BATAL</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // Notifikasi dengan Toastr
    @if(session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!');
    @elseif(session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!');
    @endif
</script>
@endsection
