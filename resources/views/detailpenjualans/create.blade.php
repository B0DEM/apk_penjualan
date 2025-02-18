@extends('layout.main')
@section('content')

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('detailpenjualans.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">ID DETAIL</label>
                                <input type="number" class="form-control" id="id_detail" name="id_detail" min="1" required>
                            </div>

                            <!-- ID Penjualan -->
                            <div class="form-group">
                                <label class="font-weight-bold">ID PENJUALAN</label>
                                <select class="form-control" name="id_penjualan" required>
                                    <option value="" disabled selected>Pilih Penjualan</option>
                                    @foreach ($penjualans as $penjualan)
                                        <option value="{{ $penjualan->id_penjualan }}">{{ $penjualan->id_penjualan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- ID Produk -->
                            <div class="form-group">
                                <label class="font-weight-bold">ID PRODUK</label>
                                <select class="form-control" id="id_produk" name="id_produk" required>
                                    <option value="" disabled selected>Pilih Produk</option>
                                    @foreach ($produks as $produk)
                                        <option value="{{ $produk->id_produk }}" data-harga="{{ $produk->harga }}">
                                            {{ $produk->nama_produk }} - Rp {{ number_format($produk->harga, 2, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Harga Produk -->
                            <div class="form-group">
                                <label class="font-weight-bold">HARGA PRODUK</label>
                                <input type="text" id="harga" class="form-control" readonly>
                            </div>
                            
                            <!-- Jumlah Produk -->
                            <div class="form-group">
                                <label class="font-weight-bold">JUMLAH PRODUK</label>
                                <input type="number" class="form-control" id="jumlah_produk" name="jumlah_produk" min="1" required>
                            </div>
                            
                            <!-- Subtotal -->
                            <div class="form-group">
                                <label class="font-weight-bold">SUBTOTAL</label>
                                <input type="text" class="form-control" id="subtotal" name="subtotal" readonly>
                            </div>
                            
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <a href="{{ route('detailpenjualans.index') }}" class="btn btn-md btn-secondary">KEMBALI</a>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let idProduk = document.getElementById("id_produk");
        let jumlahProduk = document.getElementById("jumlah_produk");
        let hargaProduk = document.getElementById("harga");
        let subtotal = document.getElementById("subtotal");

        idProduk.addEventListener("change", function() {    
            let selectedOption = this.options[this.selectedIndex];
            let harga = selectedOption.getAttribute("data-harga") || 0;

            hargaProduk.value = harga;
            hitungSubtotal();
        });

        jumlahProduk.addEventListener("input", hitungSubtotal);

        function hitungSubtotal() {
            let jumlah = parseInt(jumlahProduk.value) || 0;
            let harga = parseFloat(hargaProduk.value) || 0;
            subtotal.value = jumlah * harga;
        }
    });
</script>
@endsection
