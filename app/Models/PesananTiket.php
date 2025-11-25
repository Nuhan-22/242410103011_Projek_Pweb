<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property Collection|Tiket[] $tikets
 */
class PesananTiket extends Model
{
    use HasFactory;

    protected $table = 'pesanan_tiket';

    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'id_pengguna',
        'total_harga',
        'jumlah_tiket',
        'dibuat_saat',
        'status' // menunggu verifikasi, selesai,
    ];

    // Relation to Pengguna (many to one)
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    // Relation to Tiket (one to many)
    public function tikets()
    {
        return $this->hasMany(Tiket::class, 'id_pesanan_tiket');
    }

    // Relation to Pembayaran (one to one)
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pesanan');
    }
}
