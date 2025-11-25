<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Kategoriwisata
 *
 * @property int $id_kategori
 * @property int $id_tempat_wisata
 *
 * @property Kategori $kategori
 * @property TempatWisata $tempat_wisata
 *
 * @package App\Models
 */
class Kategoriwisata extends Model
{
	protected $table = 'kategori_wisata';
	public $timestamps = false;

	protected $casts = [
		'id_tempat_wisata' => 'int'
	];

	public function kategori()
	{
		return $this->belongsTo(Kategori::class, 'id_kategori');
	}

	public function tempat_wisata()
	{
		return $this->belongsTo(TempatWisata::class, 'id_tempat_wisata'); // force
	}
}
