<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\admin;
use App\Http\Resources\AdminResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = admin::latest()->paginate(5);
        return new AdminResource(true, 'List Data Admin', $admins);
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
    public function store(Request $request, admin $admin)
    {
        {
            $validator = Validator::make($request->all(), [
                'nama_admin'  => 'required',
                'alamat_admin'=> 'required',
                'no_hp_admin' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $admin = Admin::create([
                'nama_admin'   => $request->nama_admin,
                'alamat_admin'        => $request->alamat_admin,
                'no_hp_admin'  => $request->no_hp_admin ,
                
            ]);
    
            return new AdminResource(true, 'Data Admin Berhasil Ditambahkan!', $admin);
        }
    
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        return new AdminResource(true, 'Data Admin Ditemukan!', $admin);
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
    public function update(Request $request, admin $admin)
    {
        $validator = Validator::make($request->all(), [
            'nama_admin'  => 'required',
            'alamat_admin'=> 'required',
            'no_hp_admin' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

            $admin->update([
                'nama_admin' => $request->nama_admin,
                'alamat_admin' => $request->alamat_admin,
                'no_hp_admin' => $request->no_hp_admin,
                
            ]);
        
        return new AdminResource(true, 'Data Admin Berhasil Diubah!', $admin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(admin $admin)
    {
        $admin->delete();
        return new AdminResource(true, 'Data Admin Berhasil Dihapus!', null);
    }
}
