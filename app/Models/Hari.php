<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hari
 * 
 * @property int $id_hari
 * @property string $nama_hari
 * @property int $id_tipe_tiket
 * 
 * @property TipeTiket $tipe_tiket
 *
 * @package App\Models
 */
class Hari extends Model
{
	protected $table = 'hari';
	protected $primaryKey = 'id_hari';
	public $timestamps = false;

	protected $casts = [
		'id_tipe_tiket' => 'int'
	];

	protected $fillable = [
		'nama_hari',
		'id_tipe_tiket'
	];

	public function tipe_tiket()
	{
		return $this->belongsTo(TipeTiket::class, 'id_tipe_tiket');
	}
}
