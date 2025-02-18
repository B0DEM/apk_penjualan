<?php

namespace App\Http\Controllers;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\DetailPenjualan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        $penjualans = Penjualan::leftJoin('detailpenjualans', 'penjualans.id_penjualan', '=', 'detailpenjualans.id_penjualan')
            ->leftJoin('pelanggans', 'penjualans.id_pelanggan', '=', 'pelanggans.id_pelanggan')
            ->select(
                'penjualans.id_penjualan',
                'penjualans.tanggal_penjualan',
                'pelanggans.nama_pelanggan',
                DB::raw('COALESCE(SUM(detailpenjualans.subtotal), 0) as total_harga')
            )
            ->groupBy('penjualans.id_penjualan', 'penjualans.tanggal_penjualan', 'pelanggans.nama_pelanggan')
            ->paginate(5);
    
        return view('penjualans.index', compact('penjualans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all(); 
        return view('penjualans.create', compact('pelanggans'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'id_penjualan'     => 'required|min:2',
            'tanggal_penjualan'   => 'required',
            'total_harga'   => 'required',
            'id_pelanggan'   => 'required|min:2'
        ]);

        Penjualan::create([
            'id_penjualan'     => $request->id_penjualan,
            'tanggal_penjualan'   => $request->tanggal_penjualan,
            'total_harga'     => $request->total_harga,
            'id_pelanggan'   => $request->id_pelanggan
        ]);

        return redirect()->route('penjualans.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show($id_penjualan)
    {
        $penjualan = Penjualan::with('pelanggan', 'detailpenjualans.Produk')->find($id_penjualan);
    
        if (!$penjualan) {
            abort(404);
        }
    
        return view('penjualans.show', compact('penjualan'));
    }

    public function edit(string $id_penjualan): View
    {
        $penjualan = Penjualan::findOrFail($id_penjualan);
        $pelanggans = Pelanggan::all();
        return view('penjualans.edit', compact('penjualan', 'pelanggans'));
    }

    public function updateStatus($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->status_pembayaran = 'Lunas'; // Update status ke 'Lunas'
        $penjualan->save();
    
        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui!');
    }
    

    public function update(Request $request, $id_penjualan): RedirectResponse
    {
        $this->validate($request, [
            'id_penjualan'     => 'required|min:2',
            'tanggal_penjualan'   => 'required',
            'total_harga'   => 'required',
            'id_pelanggan'   => 'required|min:2'
        ]);

        $penjualan = Penjualan::findOrFail($id_penjualan);
        $penjualan->update([
            'id_penjualan'     => $request->id_penjualan,
            'tanggal_penjualan'   => $request->tanggal_penjualan,
            'total_harga'     => $request->total_harga,
            'id_pelanggan'   => $request->id_pelanggan
        ]);

        return redirect()->route('penjualans.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id_penjualan): RedirectResponse
    {
        $penjualan = Penjualan::findOrFail($id_penjualan);
        $penjualan->delete();

        return redirect()->route('penjualans.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
