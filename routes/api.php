<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Item;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::get('/items', function() {
    $items = Item::get();
    return response()->json(['data' => $items]);
});

Route::get('/item/{id}', function($id) {
    try {
        $item = Item::findOrFail($id);

        return response()->json([
            'message' => "Detail barang berhasil ditampilkan",
            'data' => $item
        ], 200);

    } catch (ModelNotFoundException $e) {
        return response()->json([
            'message' => "Data barang dengan ID {$id} tidak ditemukan"
        ], 404);
    }
});

Route::put('/item/{id}', function($id) {
    $item = Item::findOrFail($id);

    $item->update([
        'type' => request()->get('type', $item->type),
        'title' => request()->get('title', $item->title),
        'description' => request()->get('description', $item->description),
        'location' => request()->get('location', $item->location),
        'contact' => request()->get('contact', $item->contact),
        'status' => request()->get('status', $item->status),
    ]);

    return response()->json([
        'message' => "Laporan berhasil diperbarui",
        'data' => $item
    ]);
});

Route::post('/items', function(Request $request) {
    // 1. Validasi input dari client
    $validated = $request->validate([
        'type'    => 'required|in:lost,found', // Wajib diisi & nilainya harus 'lost' atau 'found'
        'title'   => 'required|string|max:255', // Wajib diisi, berupa teks, maksimal 255 karakter
        'description' => 'required|string|max:255', // Wajib diisi, berupa teks, maksimal 255 karakter
        'location'    => 'required|string|max:255', // Wajib diisi, berupa teks, maksimal 255 karakter
        'contact'     => 'required|string|max:255', // Wajib diisi, berupa teks, maksimal 255 karakter
    ]);

    // 2. Buat data menggunakan data yang sudah divalidasi
    $item = Item::create($validated);

    return response()->json([
        'message' => "Laporan berhasil ditambahkan",
        'data' => $item
    ], 201); // Keterangan: 201 Created
});

Route::delete('/item/{id}', function($id) {
    try {
        $item = Item::findOrFail($id);
        $item->delete();

        return response()->json([
            'message' => "Laporan berhasil dihapus",
        ], 200);

    } catch (ModelNotFoundException $e) {
        return response()->json([
            'message' => "Data barang dengan ID {$id} tidak ditemukan"
        ], 404);
    }
});