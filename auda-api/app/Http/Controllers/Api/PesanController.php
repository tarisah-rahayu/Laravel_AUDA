<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\pesan;
use App\Http\Resources\PesanResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesans = Pesan::latest()->paginate(50);
        return view('pesan', compact('pesans'));
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
        {
            $validator = Validator::make($request->all(), [
                'satuan_pesanan'  => 'required',
                'status_pesanan'=> 'required',
                'tanggal_pesan' => 'required',
                'tanggal_terima'=> 'required',
                'id_supplier' => 'required',
                'id_karyawan'=> 'required',
                'id_barang' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $pesan = Pesan::create([
                'satuan_pesanan'   => $request->satuan_pesanan,
                'status_pesanan'         => $request->status_pesanan,
                'tanggal_pesan'  => $request->tanggal_pesan,
                'tanggal_terima'         => $request->tanggal_terima,
                'id_supplier'  => $request->id_supplier,
                'id_karyawan'  => $request->id_karyawan,
                'id_barang'  => $request->id_barang,
                
            ]);
    
            return new PesanResource(true, 'Data Pesanan Berhasil Ditambahkan!', $pesan);
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(pesan $pesan)
    {
        return new PesanResource(true, 'Data Pesanan Ditemukan!', $pesan);
        
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
    public function update(Request $request, pesan $pesan)
    {
        $validator = Validator::make($request->all(), [
            'satuan_pesanan' => 'required',
            'status_pesanan' => 'required',
            'tanggal_pesan' => 'required',
            'tanggal_terima' => 'required',
            'id_supplier' => 'required',
            'id_karyawan' => 'required',
            'id_barang' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

            $pesan->update([
                'satuan_pesanan' => $request->satuan_pesanan,
                'status_pesanan' => $request->status_pesanan,
                'tanggal_pesan' => $request->tanggal_pesan,
                'tanggal_terima' => $request->tanggal_terima,
                'id_supplier' => $request->id_supplier,
                'id_karyawan' => $request->id_karyawan,
                'id_barang' => $request->id_barang,
                
            ]);
        
        return new PesanResource(true, 'Data Pesanan Berhasil Diubah!', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
