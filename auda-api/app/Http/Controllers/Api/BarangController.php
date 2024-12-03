<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\barang;
use App\Http\Resources\BarangResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs = barang::latest()->paginate(50);
        return view('barang', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang'        => 'required',
            'harga_barang'       => 'required',
            'jml_stok'           => 'required',
            'gambar'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_stok_barang' => 'required',
            'satuan'             => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $gambar = $request->file('gambar');
        $gambar->storeAs('public/barangs', $gambar->hashName());

        $barang = Barang::create([
            'nama_barang'        => $request->nama_barang,
            'harga_barang'       => $request->harga_barang,
            'jml_stok'           => $request->jml_stok,
            'gambar'             => $gambar->hashName(),
            'status_stok_barang' => $request->status_stok_barang,
            'satuan'             => $request->satuan,
        ]);

        return new BarangResource(true,'Data Barang Berhasil Ditambahkan!', $barang);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(barang $barang)
    {
        return new BarangResource(true, 'Data Barang Ditemukan!', $barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang $barang)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang'        => 'required',
            'harga_barang'       => 'required',
            'jml_stok'           => 'required',
            'gambar'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_stok_barang' => 'required',
            'satuan'             => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('gambar')){
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/barangs', $gambar->hashName());

            Storage::delete('public/barangs/'.$barang->gambar);

            $barang->update([
                'nama_barang'        => $request->nama_barang,
                'harga_barang'       => $request->harga_barang,
                'jml_stok'           => $request->jml_stok,
                'gambar'             => $gambar->hashName(),
                'status_stok_barang' => $request->status_stok_barang,
                'satuan'             => $request->satuan,
            ]);

        }else{
            $barang->update([
                'nama_barang'        => $request->nama_barang,
                'harga_barang'       => $request->harga_barang,
                'jml_stok'           => $request->jml_stok,
                'status_stok_barang' => $request->status_stok_barang,
                'satuan'             => $request->satuan,
            ]);
        }
        return new BarangResource(true, 'Data Barang Berhasil Diubah!', $barang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(barang $barang)
    {
        Storage::delete('public/barangs/'.$barang->gambar);
        $barang->delete();
        return new BarangResource(true, 'Data Barang Berhasil Dihapus!', null);
    }
}
