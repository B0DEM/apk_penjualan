@extends('layout.main')
@section('content')

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('penjualans.store') }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">ID PENJUALAN</label>
                                <input type="text" class="form-control @error('id_penjualan') is-invalid @enderror" name="id_penjualan" value="{{ old('id_penjualan') }}" placeholder="Masukkan id penjualan">
                            
                                <!-- error message untuk title -->
                                @error('id_penjualan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
    <label class="font-weight-bold">TANGGAL PENJUALAN</label>
    <input type="date" class="form-control @error('tanggal_penjualan') is-invalid @enderror" 
           name="tanggal_penjualan" 
           value="{{ now()->format('Y-m-d') }}" 
           readonly>

    @error('tanggal_penjualan')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
</div>

                            <div class="form-group">
                                <label class="font-weight-bold">TOTAL HARGA</label>
                                <input type="text" class="form-control @error('total_harga') is-invalid @enderror" name="total_harga" value="{{ old('total_harga') }}" placeholder="Masukkan total harga">
                                @error('total_harga')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
    <label class="font-weight-bold">PELANGGAN</label>
    <select class="form-control @error('id_pelanggan') is-invalid @enderror" name="id_pelanggan">
        <option value="">-- Pilih Pelanggan --</option>
        @foreach($pelanggans as $pelanggan)
            <option value="{{ $pelanggan->id_pelanggan }}" {{ old('id_pelanggan') == $pelanggan->id_pelanggan ? 'selected' : '' }}>
                {{ $pelanggan->nama_pelanggan }}
            </option>
        @endforeach
    </select>

    @error('id_pelanggan')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
</div>



                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <a href="{{ route('penjualans.index') }}" class="btn btn-md btn-secondary">KEMBALI</a>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>
@endsection