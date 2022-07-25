<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Produk::with('kategori')->paginate(10);
        return response()->json([
            'message' => 'SUCCESS',
            'data' => $data
        ], 201);
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
        $produk = Produk::latest()->first() ?? new Produk();
        $kodeProduk = 'P' . tambah_nol_didepan((int)$produk->id_produk + 1, 6);
        $validasi = $request->validate([
            'id_kategori' => ['required'],
            'nama_produk' => ['required'],
            'merk' => ['required'],
            'harga_beli' => ['required'],
            'harga_jual' => ['required'],
            'stok' => ['required'],
        ]);
        try {
            $response = Produk::create([
                'id_kategori' => $validasi['id_kategori'],
                'nama_produk' => $validasi['nama_produk'],
                'merk' => $validasi['merk'],
                'harga_beli' => $validasi['harga_beli'],
                'harga_jual' => $validasi['harga_jual'],
                'stok' => $validasi['stok'],
                'kode_produk' => $kodeProduk
            ]);
            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $response
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Err',
                'errors' => $e->getMessage()
            ], 201);
        }

        // $produk = Produk::latest()->first() ?? new Produk();
        // $request['kode_produk'] = 'P' . tambah_nol_didepan((int)$produk->id_produk + 1, 6);

        // $produk = Produk::create($request->all());

        // return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Produk::findOrFail($id);
        return response()->json([
            'message' => 'Success',
            'data' => $data,
        ], 201);
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
        Produk::findOrFail($id)->update($request->all());
        return response()->json(['message' => 'Success'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produk::destroy($id);
        return response()->json(['message' => 'Success'], 201);
    }
}
