<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return new PostResource(true, 'List Data Posts', $posts);
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
            'nama_barang'  => 'required',
            'total'        => 'required',
            'harga_barang' => 'required',
            'jml_stok'     => 'required',
            'deskripsi'    => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $post = Post::create([
            'nama_barang'   => $request->nama_barang,
            'total'         => $request->total,
            'harga_barang'  => $request->harga_barang,
            'jml_stok'      => $request->jml_stok,
            'deskripsi'     => $request->deskripsi,
        ]);

        return new PostResource(true, 'Data Barang Berhasil Ditambahkan!', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostResource(true, 'Data Barang Ditemukan!', $post);
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'total'        => 'required',
            'harga_barang' => 'required',
            'jml_stok'     => 'required',
            'deskripsi'    => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }  
            $post->update([
                'total'        => $request->total,
                'harga_barang' => $request->harga_barang,
                'jml_stok'     => $request->jml_stok,
                'deskripsi'    => $request->deskripsi,
            ]);
        
        return new PostResource(true, 'Data Barang Berhasil Diubah!', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(konsumen $konsumen)
    {
        Storage::delete('public/konsumens/'.$konsumen->nama_konsumen);
        $konsumen->delete();
        return new KonsumenResource(true, 'Data Konsumen Berhasil Dihapus!', null);
    }
}
