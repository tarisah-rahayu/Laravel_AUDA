<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\supliers;
use App\Http\Resources\SupplierResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = supliers::latest()->paginate(50);
        return view('suplier', compact('supplier'));
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
                'nama_supplier'  => 'required',
                'jenis_supplier' => 'required',
                'alamat_supplier'=> 'required',
                'no_hp_supplier' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $supplier = Supliers::create([
                'nama_supplier'   => $request->nama_supplier,
                'jenis_supplier'    => $request->jenis_supplier,
                'alamat_supplier'         => $request->alamat_supplier,
                'no_hp_supplier'  => $request->no_hp_supplier ,
                
            ]);
    
            return new SupplierResource(true, 'Data Supplier Berhasil Ditambahkan!', $supplier);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(supliers $supplier)
    {
        return new SupplierResource(true, 'Data Supplier Ditemukan!', $supplier);
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
    public function update(Request $request, supliers $supplier)
    {
        $validator = Validator::make($request->all(), [
            'nama_supplier'  => 'required',
            'jenis_supplier' => 'required',
            'alamat_supplier'=> 'required',
            'no_hp_supplier' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

            $supplier->update([
                'nama_supplier'   => $request->nama_supplier,
                'jenis_supplier'    => $request->jenis_supplier,
                'alamat_supplier'         => $request->alamat_supplier,
                'no_hp_supplier'  => $request->no_hp_supplier ,
                
            ]);
        
        return new SupplierResource(true, 'Data Supplier Berhasil Diubah!', $supplier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(supliers $supplier)
    {
        $supplier->delete();
        return new SupplierResource(true, 'Data Supplier Berhasil Dihapus!', null);
    }
}
