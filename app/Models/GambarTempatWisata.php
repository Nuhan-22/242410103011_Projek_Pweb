<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GambarTempatWisata
 *
 * @property int $id_gambar_tempat_wisata
 * @property string $url_gambar
 * @property int $id_tempat_wisata
 *
 * @property TempatWisata $tempat_wisata
 *
 * @package App\Models
 */
class GambarTempatWisata extends Model
{
	protected $table = 'gambar_tempat_wisata';
	protected $primaryKey = 'id_gambar_tempat_wisata';
	public $timestamps = false;

	protected $casts = [
		'id_tempat_wisata' => 'int'
	];

	protected $fillable = [
		'url_gambar',
		'id_tempat_wisata'
	];

	public function tempat_wisata()
	{
		return $this->belongsTo(TempatWisata::class, 'id_tempat_wisata');
	}

	/**
	 * Get the image URL with storage/ prefix if not already present
	 * This prevents double storage/ in path
	 */
	public function getImageUrlAttribute()
	{
		if (strpos($this->url_gambar, 'storage/') === 0) {
			return $this->url_gambar; // Already has storage/ prefix
		}
		return 'storage/' . $this->url_gambar; // Add prefix
	}
}
