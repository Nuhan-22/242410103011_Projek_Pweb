<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipeTiket
 *
 * @property int $id_tipe_tiket
 * @property string $nama_tipe
 * @property int $id_tempat_wisata
 * @property Carbon $waktu_dimulai
 * @property Carbon $waktu_berakhir
 * @property float $harga
 *
 * @property TempatWisata $tempat_wisata
 * @property Collection|Hari[] $hari
 * @property Collection|Tiket[] $tikets
 *
 * @package App\Models
 */
class TipeTiket extends Model
{
	protected $table = 'tipe_tiket';
	protected $primaryKey = 'id_tipe_tiket';
	public $timestamps = false;

	protected $casts = [
		'id_tempat_wisata' => 'int',
		'waktu_dimulai' => 'datetime',
		'waktu_berakhir' => 'datetime',
		'harga' => 'float'
	];

	protected $fillable = [
		'nama_tipe',
		'id_tempat_wisata',
		'waktu_dimulai',
		'waktu_berakhir',
		'harga'
	];

	public function tempat_wisata()
	{
		return $this->belongsTo(TempatWisata::class, 'id_tempat_wisata');
	}

    public function tikets(){
        return $this->hasMany(Tiket::class, 'id_tipe_tiket');
    }


	public function hari()
	{
		return $this->hasMany(Hari::class, 'id_tipe_tiket');
	}
}
