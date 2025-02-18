<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::latest()->paginate(5);
        return view('produks.index', compact('produks'));
    }   

    public function create()
    {
        return view('produks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required|integer',
        ]);
    
        // Membersihkan format harga agar hanya angka yang tersimpan
        $cleaned_harga = str_replace(['Rp', '.', ','], '', $request->harga);
    
        Produk::create([
            'id_produk' => $request->id_produk,
            'nama_produk' => $request->nama_produk,
            'harga' => $cleaned_harga,  // Pastikan hanya angka yang disimpan
            'stok' => $request->stok,
        ]);
    
        return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id_produk)
    {
        $produk = Produk::findOrFail($id_produk);
        return view('produks.edit', compact('produk'));
    }

    public function update(Request $request, $id_produk)
    {
        $request->validate([
            'id_produk' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer',
        ]);
    
        $produk = Produk::findOrFail($id_produk);
    
        // Membersihkan format harga
        $cleaned_harga = str_replace(['Rp', '.', ','], '', $request->harga);
    
        $produk->update([
            'id_produk' => $request->id_produk,
            'nama_produk' => $request->nama_produk,
           'harga' => (float) $request->harga,
            'stok' => $request->stok,
        ]);
    
        return redirect()->route('produks.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id_produk)
    {
        $produk = Produk::findOrFail($id_produk);
        $produk->delete();

        return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus.');
    }
}