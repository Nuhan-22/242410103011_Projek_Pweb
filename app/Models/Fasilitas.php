<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Fasilita
 *
 * @property int $id_fasilitas
 * @property string $nama_fasilitas
 * @property int $id_tempat_wisata
 *
 * @property TempatWisata $tempat_wisata
 *
 * @package App\Models
 */
class Fasilitas extends Model
{
	protected $table = 'fasilitas';
	protected $primaryKey = 'id_fasilitas';
	public $timestamps = false;

	protected $casts = [
		'id_tempat_wisata' => 'int'
	];

	protected $fillable = [
		'nama_fasilitas',
		'id_tempat_wisata'
	];

	public function tempat_wisata()
	{
		return $this->belongsTo(TempatWisata::class, 'id_tempat_wisata');
	}
}
