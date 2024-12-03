<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\karyawan;
use App\Http\Resources\KaryawanResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = karyawan::latest()->paginate(50);
        return view('karyawan', compact('karyawans'));
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
                'nama_karyawan'  => 'required',
                'posisi'         => 'required',
                'alamat'         => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $karyawan = Karyawan::create([
                'nama_karyawan'  => $request->nama_karyawan,
                'posisi'         => $request->posisi,
                'alamat'         => $request->alamat ,
                
            ]);
    
            return new KaryawanResource(true, 'Data Karyawan Berhasil Ditambahkan!', $karyawan);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(karyawan $karyawan)
    {
        return new KaryawanResource(true, 'Data Karyawan Ditemukan!', $karyawan);
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
    public function update(Request $request, karyawan $karyawan)
    {
        $validator = Validator::make($request->all(), [
            'nama_karyawan'  => 'required',
            'posisi'         => 'required',
            'alamat'         => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

            $karyawan->update([
                'nama_karyawan'  => $request->nama_karyawan,
                'posisi'         => $request->posisi,
                'alamat'         => $request->alamat ,
                
            ]);
        
        return new KaryawanResource(true, 'Data Karyawan Berhasil Diubah!', $karyawan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(karyawan $karyawan)
    {
        $karyawan->delete();
        return new KaryawanResource(true, 'Data Karyawan Berhasil Dihapus!', null);
    }
}
