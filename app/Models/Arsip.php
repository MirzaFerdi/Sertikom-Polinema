<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    protected $table = 'arsip';

    protected $fillable = [
        'nomor_surat',
        'kategori_id',
        'judul',
        'waktu_pengarsipan',
        'file',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriSurat::class);
    }
}
