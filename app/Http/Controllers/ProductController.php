<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = ProductModel::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Products Berhasil Dimuat',
            'data' => $products
        ], 200);
    }

    // Menampilkan produk tertentu
    public function show($id)
    {
        $product = ProductModel::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product Ditemukan',
            'data' => $product
        ], 200);
    }

    // Menambahkan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product = ProductModel::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Product Berhasil Ditambahkan',
            'data' => $product
        ], 201);
    }

    // Memperbarui produk
    public function update(Request $request, $id)
    {
        $product = ProductModel::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product Tidak Ditemukan'
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'sometimes|required|numeric',
            'stock' => 'sometimes|required|integer',
        ]);

        $product->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Product Berhasil Diupdate',
            'data' => $product
        ], 200);
    }

    // Menghapus produk
    public function destroy($id)
    {
        $product = ProductModel::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product Tidak Ditemukan'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product Berhasil Dihapus'
        ], 200);
    }
}
