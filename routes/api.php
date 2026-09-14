<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Item;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

// BROWSE: Menampilkan daftar barang hilang & ditemukan
Route::get('/items', function() {
    $items = Item::get();
    return response()->json(['data' => $items]);
});

// READ: Menampilkan detail spesifik satu laporan barang
Route::get('/item/{id}', function($id) {
    $item = Item::findOrFail($id);
    return response()->json([
        'message' => "Detail barang berhasil ditampilkan",
        'data' => $item
    ]);
});

// EDIT: Mengupdate laporan (misal: barang sudah dikembalikan, ubah status jadi resolved)
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
    ]);
});

// ADD: Membuat laporan barang hilang/ditemukan baru
Route::post('/items', function() {
    $item = Item::create([
        'type' => request()->get('type'),
        'title' => request()->get('title'),
        'description' => request()->get('description'),
        'location' => request()->get('location'),
        'contact' => request()->get('contact'),
    ]);

    return response()->json([
        'message' => "Laporan berhasil ditambahkan",
        'data' => $item
    ]);
});

// DELETE: Menghapus laporan jika terindikasi spam / salah lapor
Route::delete('/item/{id}', function($id) {
    $item = Item::findOrFail($id);
    $item->delete();

    return response()->json([
        'message' => "Laporan berhasil dihapus",
    ]);
});
