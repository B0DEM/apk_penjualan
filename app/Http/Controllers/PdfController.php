<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Detailpenjualan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    // Generate PDF untuk Detail Penjualan
    public function generatePdf()
    {
        $detailpenjualans = Detailpenjualan::all();
        $data = [
            'detailpenjualans' => $detailpenjualans,
            'title' => 'Laporan Data Detail Penjualan',
            'date' => date('d-m-Y')
        ];

        $pdf = Pdf::loadView('pdf.laporan_detailpenjualan', $data);
        return $pdf->download('laporan_detailpenjualan.pdf');
    }

    // Generate PDF untuk Laporan Penjualan
    public function generateLaporanPenjualanPdf()
    {
        $penjualans = Penjualan::with('pelanggan')->get(); // Mengambil data penjualan dengan relasi pelanggan
        $data = [
            'penjualans' => $penjualans,
            'title' => 'Laporan Penjualan',
            'date' => date('d-m-Y')
        ];

        $pdf = Pdf::loadView('pdf.laporan_penjualan', $data);
        return $pdf->download('laporan_penjualan.pdf');
    }
}
