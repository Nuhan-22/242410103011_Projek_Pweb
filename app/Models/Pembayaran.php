<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_pesanan',
        'bukti_pembayaran',
        // 'status', // dimatikan karena business logic otomatis harus mengirim bukti pembayaran sebelum
    ];

    // Relation to PesananTiket (many to one)
    public function pesanan_tiket()
    {
        return $this->hasMany(PesananTiket::class, 'id_pesanan');
    }

    public function rekening_bank(){
        return $this->hasOne(RekeningBank::class, 'id_rekening_bank');
    }
}
