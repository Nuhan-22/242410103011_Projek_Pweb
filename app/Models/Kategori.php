<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Kategori
 *
 * @property int $id_kategori
 * @property string $nama_kategori
 *
 * @property Collection|Kategoriwisata[] $kategori_wisata
 *
 * @package App\Models
 */
class Kategori extends Model
{
	protected $table = 'kategori';
	protected $primaryKey = 'id_kategori';
	public $timestamps = false;

	protected $fillable = [
		'nama_kategori'
	];

	public function kategori_wisata()
	{
		return $this->hasMany(Kategoriwisata::class, 'id_kategori');
	}
}
