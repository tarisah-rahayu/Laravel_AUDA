<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\jual;
use App\Http\Resources\JualResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class JualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $juals = jual::latest()->paginate(50);
        return view('jual', compact('juals'));
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
                'alamat_penerima'     => 'required',
                'tgl_jual'            => 'required',
                'tgl_kirim'           => 'required',
                'qty'                 => 'required',
                'satuan'              => 'required',
                'status'              => 'required',
                'id_barang'           => 'required',
                'id_konsumen'         => 'required',
                
                
                
            ]);
          
            $jual = Jual::create([
                'alamat_penerima'     => $request->alamat_penerima,
                'tgl_jual'            => $request->tgl_jual,
                'tgl_kirim'           => $request->tgl_kirim,
                'qty'                 => $request->qty,
                'satuan'              => $request->satuan,
                'status'              => $request->status,
                'id_barang'           => $request->id_barang,
                'id_konsumen'         => $request->id_konsumen,
                

            ]);
    
            return new JualResource(true, 'Data Jual Berhasil Ditambahkan!', $jual);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(jual $jual)
    {
        return new JualResource(true, 'Data Penjualan Ditemukan!', $jual);
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
    public function update(Request $request, jual $jual)
    {
        $validator = Validator::make($request->all(), [
                'alamat_penerima'     => 'required',
                'tgl_jual'            => 'required',
                'tgl_kirim'           => 'required',
                'qty'                 => 'required',
                'satuan'              => 'required',
                'status'              => 'required',
                'id_barang'         => 'required',
                'id_konsumen'         => 'required',
                
                
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

            $jual->update([
                'alamat_penerima'     => $request->alamat_penerima,
                'tgl_jual'            => $request->tgl_jual,
                'tgl_kirim'           => $request->tgl_kirim,
                'qty'                 => $request->qty,
                'satuan'              => $request->satuan,
                'status'              => $request->status,
                'id_barang'           => $request->id_barang,
                'id_konsumen'         => $request->id_konsumen,
                
                
            ]);
        
        return new JualResource(true, 'Data Jual Berhasil Diubah!', $jual);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(jual $jual)
    {
        $jual->delete();
        return new JualResource(true, 'Data Jual Berhasil Dihapus!', null);
    }
}
