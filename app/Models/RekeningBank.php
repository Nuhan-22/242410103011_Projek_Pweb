<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RekeningBank
 *
 * @property int $id_rekening_bank
 * @property string $nama_bank
 * @property string $nomer_rekening
 *
 * @property Collection|TempatWisata[] $tempat_wisata
 * @property Collection|Pembayaran[] $pembayaran
 *
 * @package App\Models
 */
class RekeningBank extends Model
{
    protected $table = 'rekening_bank';
    protected $primaryKey = 'id_rekening_bank';
    public $timestamps = false;

    protected $fillable = [
        'nama_bank',
        'nomer_rekening',
        'id_tempat_wisata'
    ];

    public function tempat_wisata()
    {
        return $this->belongsTo(TempatWisata::class, 'id_tempat_wisata');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_rekening_bank');
    }
}
