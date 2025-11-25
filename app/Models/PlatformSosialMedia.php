<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PlatformSosialMedia
 *
 * @property int $id_platform
 * @property string $nama_platform
 *
 * @property Collection|SosialMedia[] $sosial_media
 *
 * @package App\Models
 */
class PlatformSosialMedia extends Model
{
	protected $table = 'platform_sosial_media';
	protected $primaryKey = 'id_platform';
	public $timestamps = false;

	protected $fillable = [
		'nama_platform'
	];

	public function sosial_media()
	{
		return $this->hasMany(SosialMedia::class, 'id_platform');
	}
}
