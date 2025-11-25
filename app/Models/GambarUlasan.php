<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GambarUlasan
 * 
 * @property int $id_gambar_ulasan
 * @property string $url_gambar
 * @property int $id_ulasan
 * 
 * @property Ulasan $ulasan
 *
 * @package App\Models
 */
class GambarUlasan extends Model
{
	protected $table = 'gambar_ulasan';
	protected $primaryKey = 'id_gambar_ulasan';
	public $timestamps = false;

	protected $casts = [
		'id_ulasan' => 'int'
	];

	protected $fillable = [
		'url_gambar',
		'id_ulasan'
	];

	public function ulasan()
	{
		return $this->belongsTo(Ulasan::class, 'id_ulasan');
	}
}
