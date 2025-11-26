<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Carousel
 *
 * @property int $id_carousel
 * @property string $judul
 * @property string|null $deskripsi
 * @property string $url_gambar
 * @property string|null $link_button
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Carousel extends Model
{
	protected $table = 'carousels';
	protected $primaryKey = 'id_carousel';

	protected $fillable = [
		'judul',
		'deskripsi',
		'url_gambar',
		'link_button'
	];

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
