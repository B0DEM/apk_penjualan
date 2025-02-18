<?php

namespace App\Http\Controllers;
use App\Models\Pelanggan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class PelangganController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        $pelanggans = Pelanggan::latest()->paginate(5);
        return view('pelanggans.index', compact('pelanggans'));
    }
/**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('pelanggans.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'id_pelanggan'     => 'required|min:2',
            'nama_pelanggan'   => 'required|min:2',
            'alamat'   => 'required|min:2',
            'no_telpon'   => 'required|min:2'
        ]);

        //create post
        Pelanggan::create([
            'id_pelanggan'     => $request->id_pelanggan,
            'nama_pelanggan'   => $request->nama_pelanggan,
            'alamat'   => $request->alamat,
            'no_telpon'   => $request->no_telpon
        ]);

        //redirect to index
        return redirect()->route('pelanggans.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id_pelanggan): View
    {
        //get post by ID
        $pelanggan = Pelanggan::findOrFail($id_pelanggan);

        //render view with post
        return view('pelanggans.show', compact('pelanggan'));
    }
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id_pelanggan): View
    {
        //get post by ID
        $pelanggan = Pelanggan::findOrFail($id_pelanggan);

        //render view with post
        return view('pelanggans.edit', compact('pelanggan'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id_pelanggan): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'id_pelanggan'     => 'required|min:2',
            'nama_pelanggan'   => 'required|min:2',
            'alamat'   => 'required|min:2',
            'no_telpon'   => 'required|min:2'
        ]);
        //get post by ID
        $pelanggan = Pelanggan::findOrFail($id_pelanggan);

            //update post without image
            $pelanggan->update([
            'id_pelanggan'     => $request->id_pelanggan,
            'nama_pelanggan'   => $request->nama_pelanggan,
            'alamat'   => $request->alamat,
            'no_telpon'   => $request->no_telpon
            ]);

        //redirect to index
        return redirect()->route('pelanggans.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id_pelanggan): RedirectResponse
    {
        //get post by ID
        $pelanggan = Pelanggan::findOrFail($id_pelanggan);

        //delete post
        $pelanggan->delete();

        //redirect to index
        return redirect()->route('pelanggans.index')->with(['success' => 'Data Berhasil Dihapus!']);}
}