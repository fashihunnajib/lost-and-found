<?php

namespace App;

/**
 * @OA\Info(
 *     title="API Lost & Found Documentation",
 *     version="1.0.0",
 *     description="Dokumentasi OpenAPI untuk API Pelacakan Barang Hilang dan Ditemukan"
 * )
 * 
 * @OA\Schema(
 *     schema="Item",
 *     type="object",
 *     required={"type", "title", "description", "location", "contact"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="type", type="string", enum={"lost", "found"}, example="found"),
 *     @OA\Property(property="title", type="string", example="Dompet Kulit Coklat"),
 *     @OA\Property(property="description", type="string", example="Ditemukan di bangku taman kampus"),
 *     @OA\Property(property="location", type="string", example="Taman Kampus"),
 *     @OA\Property(property="contact", type="string", example="081234567890"),
 *     @OA\Property(property="status", type="string", enum={"open", "resolved"}, example="open"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2026-09-14T15:10:13.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2026-09-14T15:10:13.000000Z")
 * )
 * 
 * @OA\Get(
 *     path="/api/items",
 *     summary="BROWSE: Menampilkan daftar barang hilang & ditemukan",
 *     tags={"Items"},
 *     @OA\Response(
 *         response=200,
 *         description="Berhasil mengambil daftar barang",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Item"))
 *         )
 *     )
 * )
 * 
 * @OA\Get(
 *     path="/api/item/{id}",
 *     summary="READ: Menampilkan detail spesifik satu laporan barang",
 *     tags={"Items"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID barang yang dicari",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detail barang berhasil ditampilkan",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Detail barang berhasil ditampilkan"),
 *             @OA\Property(property="data", ref="#/components/schemas/Item")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Data barang tidak ditemukan",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Data barang dengan ID 1 tidak ditemukan")
 *         )
 *     )
 * )
 * 
 * @OA\Post(
 *     path="/api/items",
 *     summary="ADD: Membuat laporan barang hilang/ditemukan baru",
 *     tags={"Items"},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Data laporan barang baru yang wajib diisi",
 *         @OA\JsonContent(
 *             required={"type", "title", "description", "location", "contact"},
 *             @OA\Property(property="type", type="string", enum={"lost", "found"}, example="found"),
 *             @OA\Property(property="title", type="string", example="Jas Poliwangi"),
 *             @OA\Property(property="description", type="string", example="Ditemukan di kelas GKT"),
 *             @OA\Property(property="location", type="string", example="GKT"),
 *             @OA\Property(property="contact", type="string", example="081133332121")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Laporan berhasil ditambahkan",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Laporan berhasil ditambahkan"),
 *             @OA\Property(property="data", ref="#/components/schemas/Item")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validasi gagal",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The type field is required.")
 *         )
 *     )
 * )
 * 
 * @OA\Put(
 *     path="/api/item/{id}",
 *     summary="EDIT: Mengupdate laporan barang",
 *     tags={"Items"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID barang yang akan diupdate",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Data laporan yang diperbarui",
 *         @OA\JsonContent(
 *             @OA\Property(property="type", type="string", enum={"lost", "found"}, example="found"),
 *             @OA\Property(property="title", type="string", example="Dompet Kulit Coklat (Sudah Diambil)"),
 *             @OA\Property(property="description", type="string", example="Ditemukan di bangku taman kampus"),
 *             @OA\Property(property="location", type="string", example="Taman Kampus"),
 *             @OA\Property(property="contact", type="string", example="081234567890"),
 *             @OA\Property(property="status", type="string", enum={"open", "resolved"}, example="resolved")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Laporan berhasil diperbarui",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Laporan berhasil diperbarui")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Data barang tidak ditemukan"
 *     )
 * )
 * 
 * @OA\Delete(
 *     path="/api/item/{id}",
 *     summary="DELETE: Menghapus laporan barang",
 *     tags={"Items"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID barang yang akan dihapus",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Laporan berhasil dihapus",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Laporan berhasil dihapus")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Data barang tidak ditemukan"
 *     )
 * )
 */
class SwaggerDoc
{
    // File ini khusus menampung dokumentasi OpenAPI/Swagger
}