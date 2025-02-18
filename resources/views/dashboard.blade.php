@extends('layout.main')
@section('content')

<?php
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Detailpenjualan;
use App\Models\Produk;

$jumlahPelanggan = Pelanggan::count();
$jumlahPenjualan = Penjualan::count();
$jumlahDetailPenjualan = Detailpenjualan::count();
$jumlahProduk = Produk::count();
?>

<style>
    .custom-shadow {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.7) !important; /* Shadow hitam lebih tebal */
    }
</style>

<div class="content-wrapper">
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2"> Overview Dashboard </h2>
    </div>

    <div class="tab-content tab-transparent-content">
        <div class="tab-pane fade show active" id="business-1" role="tabpanel">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                    <div class="card bg-primary text-white rounded-lg shadow-lg custom-shadow">
                        <div class="card-body text-center">
                            <h5 class="mb-2 font-weight-normal">Pelanggan</h5>
                            <h2 class="mb-4 font-weight-bold">{{ $jumlahPelanggan }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                    <div class="card bg-success text-white rounded-lg shadow-lg custom-shadow">
                        <div class="card-body text-center">
                            <h5 class="mb-2 font-weight-normal">Penjualan</h5>
                            <h2 class="mb-4 font-weight-bold">{{ $jumlahPenjualan }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                    <div class="card bg-warning text-white rounded-lg shadow-lg custom-shadow">
                        <div class="card-body text-center">
                            <h5 class="mb-2 font-weight-normal">Detail Penjualan</h5>
                            <h2 class="mb-4 font-weight-bold">{{ $jumlahDetailPenjualan }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                    <div class="card bg-danger text-white rounded-lg shadow-lg custom-shadow">
                        <div class="card-body text-center">
                            <h5 class="mb-2 font-weight-normal">Produk</h5>
                            <h2 class="mb-4 font-weight-bold">{{ $jumlahProduk }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection