<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\konsumen;
use App\Http\Resources\KonsumenResource;
use Illuminate\Support\Facades\Validator;

class KonsumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $konsumens = konsumen::latest()->paginate(5);
        return new KonsumenResource(true, 'List Data Konsumen', $konsumens);
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
                'nama_konsumen'  => 'required',
                'alamat_konsumen'=> 'required',
                'no_hp_konsumen' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $konsumen = Konsumen::create([
                'nama_konsumen'   => $request->nama_konsumen,
                'alamat_konsumen'         => $request->alamat_konsumen,
                'no_hp_konsumen'  => $request->no_hp_konsumen ,
                
            ]);
    
            return new KonsumenResource(true, 'Data Konsumen Berhasil Ditambahkan!', $konsumen);
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(konsumen $konsumen)
    {
        return new KonsumenResource(true, 'Data Konsumen Ditemukan!', $konsumen);
        
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
    public function update(Request $request, konsumen $konsumen)
    {
        $validator = Validator::make($request->all(), [
            'nama_konsumen' => 'required',
            'alamat_konsumen' => 'required',
            'no_hp_konsumen' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

            $konsumen->update([
                'nama_konsumen' => $request->nama_konsumen,
                'alamat_konsumen' => $request->alamat_konsumen,
                'no_hp_konsumen' => $request->no_hp_konsumen,
                
            ]);
        
        return new KonsumenResource(true, 'Data Konsumen Berhasil Diubah!', $konsumen);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(konsumen $konsumen)
    {
    
        $konsumen->delete();
        return new KonsumenResource(true, 'Data Konsumen Berhasil Dihapus!', null);
    }
}
