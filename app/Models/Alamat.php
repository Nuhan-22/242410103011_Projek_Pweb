<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Alamat
 *
 * @property int $id_alamat
 * @property string $provinsi
 * @property string $kota
 * @property string $jalan
 * @property string $kecamatan
 * @property int $id_tempat_wisata
 *
 * @property TempatWisata $tempat_wisata
 *
 * @package App\Models
 */
class Alamat extends Model
{
	protected $table = 'alamat';
	protected $primaryKey = 'id_alamat';
	public $timestamps = false;

	protected $casts = [
		'id_tempat_wisata' => 'int'
	];

	protected $fillable = [
		'provinsi',
		'kota',
		'jalan',
		'kecamatan',
		'kabupaten',
		'id_tempat_wisata'
	];

	public function tempat_wisata()
	{
		return $this->belongsTo(TempatWisata::class, 'id_tempat_wisata');
	}
}
