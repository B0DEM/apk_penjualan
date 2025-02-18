<?php

namespace App\Http\Controllers;

use App\Models\Detailpenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailpenjualanController extends Controller
{
    public function index()
    {
        $detailpenjualans = Detailpenjualan::with(['penjualan', 'produk'])->paginate(5);
        return view('detailpenjualans.index', compact('detailpenjualans'));
    }

    public function create()
    {
        $penjualans = Penjualan::all();
        $produks = Produk::all();
        return view('detailpenjualans.create', compact('penjualans', 'produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_detail'     => 'nullable|integer|unique:detailpenjualans,id_detail',
            'id_penjualan'  => 'required|exists:penjualans,id_penjualan',
            'id_produk'     => 'required|exists:produks,id_produk',
            'jumlah_produk' => 'required|integer|min:1',
            'subtotal'      => 'required|numeric|min:0',
        ]);
    
        DB::beginTransaction();
        try {
            $produk = Produk::findOrFail($request->id_produk);
    
            // Cek apakah stok mencukupi sebelum menyimpan data
            if ($produk->stok < $request->jumlah_produk) {
                return back()->with('error', 'Stok tidak cukup!');
            }
    
            Detailpenjualan::create([
                'id_detail'     => $request->id_detail ?? Detailpenjualan::max('id_detail') + 1,
                'id_penjualan'  => $request->id_penjualan,
                'id_produk'     => $request->id_produk,
                'jumlah_produk' => $request->jumlah_produk,
                'subtotal'      => $request->subtotal,
            ]);
    
            // Kurangi stok produk setelah berhasil disimpan
            $produk->stok -= $request->jumlah_produk;
            $produk->save();
    
            DB::commit();
            return redirect()->route('detailpenjualans.index')->with('success', 'Detail penjualan berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function edit($id)
    {
        $detailpenjualan = Detailpenjualan::findOrFail($id);
        $penjualans = Penjualan::all();
        $produks = Produk::all();
        return view('detailpenjualans.edit', compact('detailpenjualan', 'penjualans', 'produks'));
    }

     public function show($id)
    {
        // Ambil data detail penjualan berdasarkan ID
        $detail = DetailPenjualan::with(['penjualan.pelanggan', 'produk'])->findOrFail($id);
        
        // Return ke tampilan show dengan data detail
        return view('detailpenjualans.show', compact('detail'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'id_penjualan'  => 'required|exists:penjualans,id_penjualan',
        'id_produk'     => 'required|exists:produks,id_produk',
        'jumlah_produk' => 'required|integer|min:1',
        'subtotal'      => 'required|numeric|min:0',
    ]);

    DB::beginTransaction();
    try {
        $detailpenjualan = Detailpenjualan::findOrFail($id);
        
        // Kembalikan stok lama sebelum update
        $produkLama = Produk::find($detailpenjualan->id_produk);
        if ($produkLama) {
            $produkLama->stok += $detailpenjualan->jumlah_produk;
            $produkLama->save();
        }

        // Cek stok produk baru sebelum update
        $produkBaru = Produk::findOrFail($request->id_produk);
        if ($produkBaru->stok < $request->jumlah_produk) {
            return back()->with('error', 'Stok tidak cukup untuk update!');
        }

        // Kurangi stok produk baru setelah update
        $produkBaru->stok -= $request->jumlah_produk;
        $produkBaru->save();

        // Update data detail penjualan
        $detailpenjualan->update([
            'id_penjualan'  => $request->id_penjualan,
            'id_produk'     => $request->id_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'subtotal'      => $request->subtotal,
        ]);

        DB::commit();
        return redirect()->route('detailpenjualans.index')->with('success', 'Detail penjualan berhasil diperbarui!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $detailpenjualan = Detailpenjualan::findOrFail($id);

            // Kembalikan stok sebelum menghapus
            $produk = Produk::find($detailpenjualan->id_produk);
            if ($produk) {
                $produk->stok += $detailpenjualan->jumlah_produk;
                $produk->save();
            }

            // Hapus data
            $detailpenjualan->delete();

            DB::commit();
            return redirect()->route('detailpenjualans.index')->with('success', 'Detail penjualan berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}