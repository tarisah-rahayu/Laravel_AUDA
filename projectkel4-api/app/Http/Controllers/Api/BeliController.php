<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\beli;
use App\Http\Resources\BeliResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $belis = beli::latest()->paginate(5);
        return new BeliResource(true, 'Data Pembelian Barang' , $belis);
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
            'alamat_penerima'  => 'required',
            'tanggal_beli'        => 'required',
            'tanggal_kirim' => 'required',
            'qty'    => 'required',
            'status'     => 'required',
            'id_konsumen'    => 'required',
            'id_barang'     => 'required',
        ]);



        $beli = Beli::create([
            'alamat_penerima'   => $request->alamat_penerima,
            'tanggal_beli'         => $request->tanggal_beli,
            'tanggal_kirim'  => $request->tanggal_kirim,
            'qty'      => $request->qty,
            'status'     => $request->status,
            'id_konsumen'     => $request->id_konsumen,
            'id_barang'     => $request->id_barang,
        ]);

        return new BeliResource(true,'Transaksi Berhasil Ditambahkan!', $beli);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(beli $beli)
    {
        return new BeliResource(true, 'Data Beli Ditemukan!', $beli);
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
    public function update(Request $request, beli $beli)
    {
        $validator = Validator::make($request->all(), [
            'alamat_penerima' => 'required',
            'tanggal_beli' => 'required',
            'tanggal_kirim' => 'required',
            'qty' => 'required',
            'status' => 'required',
            'id_konsumen' => 'required',
            'id_barang' => 'required',
            
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

            $beli->update([
                'alamat_penerima' => $request->alamat_penerima,
                'tanggal_beli' => $request->tanggal_beli,
                'tanggal_kirim' => $request->tanggal_kirim,
                'qty' => $request->qty,
                'status' => $request->status,
                'id_konsumen' => $request->id_konsumen,
                'id_barang' => $request->id_barang,
                
            ]);
        
        return new BeliResource(true, 'Data Pembelian Berhasil Diubah!', $beli);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(beli $beli)
    {
      
        $beli->delete();
        return new BeliResource(true, 'Data Pembelian Berhasil Dihapus!', null);
    }
}
