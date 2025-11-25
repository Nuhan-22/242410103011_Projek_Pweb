<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ulasan
 *
 * @property int $id_ulasan
 * @property int|null $nilai_rating
 * @property string $isi_komentar
 * @property int $id_tempat_wisata
 * @property int $id_pengguna
 * @property int|null $id_ulasan_yg_dibalas
 *
 * @property Pengguna $pengguna
 * @property TempatWisata $tempat_wisata
 * @property Ulasan|null $ulasan
 * @property Collection|GambarUlasan[] $gambar_ulasans
 * @property Collection|Ulasan[] $ulasans
 *
 * @package App\Models
 */
class Ulasan extends Model
{
	protected $table = 'ulasan';
	protected $primaryKey = 'id_ulasan';
	public $timestamps = false;

	protected $casts = [
		'nilai_rating' => 'int',
		'id_tempat_wisata' => 'int',
		'id_pengguna' => 'int',
		'id_ulasan_yg_dibalas' => 'int'
	];

	protected $fillable = [
		'nilai_rating',
		'isi_komentar',
		'id_tempat_wisata',
		'id_pengguna',
		'id_ulasan_yg_dibalas'
	];

	public function pengguna()
	{
		return $this->belongsTo(Pengguna::class, 'id_pengguna');
	}

	public function tempat_wisata()
	{
		return $this->belongsTo(TempatWisata::class, 'id_tempat_wisata');
	}

	public function ulasan()
	{
		return $this->belongsTo(Ulasan::class, 'id_ulasan_yg_dibalas');
	}

	public function gambar_ulasans()
	{
		return $this->hasMany(GambarUlasan::class, 'id_ulasan');
	}

	public function ulasans()
	{
		return $this->hasMany(Ulasan::class, 'id_ulasan_yg_dibalas');
	}
}
