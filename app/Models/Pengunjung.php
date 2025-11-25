<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pengunjung
 * 
 * @property int $id
 * @property Carbon $waktu_kunjungan
 * @property string|null $alamat_ip
 * @property string|null $user_agent
 *
 * @package App\Models
 */
class Pengunjung extends Model
{
	protected $table = 'pengunjung';
	public $timestamps = false;

	protected $casts = [
		'waktu_kunjungan' => 'datetime'
	];

	protected $fillable = [
		'waktu_kunjungan',
		'alamat_ip',
		'user_agent'
	];
}
