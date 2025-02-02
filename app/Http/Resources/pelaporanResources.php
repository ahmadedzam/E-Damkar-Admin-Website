<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class pelaporanResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "idLaporan" => $this->idLaporan,
            "Status_riwayat" => $this->statusRiwayat->nama_status, 
            "kategori_laporan" => $this->kategoriLaporan->nama_kategori, 
            "tanggal" => $this->tgl_lap, 
            "deskripsi" => $this->deskripsi_laporan, 
            "image_url" => $this->gambar_bukti_pelaporan, 
            "alamat" => $this->alamat_kejadian
        ];
    }
}
