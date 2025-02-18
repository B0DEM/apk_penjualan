@extends('layout.main')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="mb-0">Edit Detail Penjualan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('detailpenjualans.update', $detailpenjualan->id_detail) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- ID Penjualan (Readonly) -->
                    <div class="mb-3">
                        <label for="id_penjualan" class="form-label">ID Penjualan</label>
                        <input type="text" class="form-control" value="{{ $detailpenjualan->id_penjualan }}" disabled>
                        <input type="hidden" name="id_penjualan" value="{{ $detailpenjualan->id_penjualan }}">
                    </div>

                    <!-- Produk (Editable) -->
                    <div class="mb-3">
                        <label for="id_produk" class="form-label">Produk</label>
                        <select name="id_produk" id="id_produk" class="form-select" required>
                            @foreach($produks as $produk)
                                <option value="{{ $produk->id_produk }}"
                                    {{ $detailpenjualan->id_produk == $produk->id_produk ? 'selected' : '' }}
                                    data-harga="{{ $produk->harga }}">
                                    {{ $produk->nama_produk }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Harga Produk (Readonly) -->
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Produk</label>
                        <input type="text" id="harga" class="form-control" value="{{ $detailpenjualan->produk->harga ?? 0 }}" readonly>
                    </div>

                    <!-- Jumlah Produk (Editable) -->
                    <div class="mb-3">
                        <label for="jumlah_produk" class="form-label">Jumlah Produk</label>
                        <input type="number" name="jumlah_produk" id="jumlah_produk" class="form-control" min="1" value="{{ $detailpenjualan->jumlah_produk }}" required>
                    </div>

                    <!-- Subtotal -->
                    <div class="mb-3">
                        <label for="subtotal" class="form-label">Subtotal</label>
                        <input type="text" class="form-control" id="subtotal_display" value="{{ $detailpenjualan->subtotal }}" disabled>
                        <input type="hidden" name="subtotal" id="subtotal" value="{{ $detailpenjualan->subtotal }}">
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('detailpenjualans.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let jumlahInput = document.getElementById('jumlah_produk');
            let produkSelect = document.getElementById('id_produk');
            let hargaInput = document.getElementById('harga');
            let subtotalInput = document.getElementById('subtotal');
            let subtotalDisplay = document.getElementById('subtotal_display');

            function updateSubtotal() {
                let hargaProduk = produkSelect.options[produkSelect.selectedIndex].getAttribute('data-harga') || 0;
                let jumlah = jumlahInput.value || 0;
                let subtotal = hargaProduk * jumlah;

                hargaInput.value = hargaProduk;
                subtotalInput.value = subtotal;
                subtotalDisplay.value = subtotal.toLocaleString('id-ID');
            }

            produkSelect.addEventListener('change', updateSubtotal);
            jumlahInput.addEventListener('input', updateSubtotal);
            updateSubtotal();
        });
    </script>
@endsection
