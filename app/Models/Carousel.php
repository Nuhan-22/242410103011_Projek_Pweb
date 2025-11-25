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
}
