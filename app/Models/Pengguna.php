<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

/**
 * Class Pengguna
 *
 * @property int $id_pengguna
 * @property string $nama_depan
 * @property string $nama_belakang
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $username
 * @property string $password
 * @property string|null $foto_profil
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $remember_token
 * @property int $id_role
 *
 * @property Role $role
 * @property Collection|Ulasan[] $ulasans
 *
 * @package App\Models
 */
class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';

    protected $casts = [
        'email_verified_at' => 'datetime',
        'id_role' => 'int',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'email',
        'email_verified_at',
        'username',
        'password',
        'foto_profil',
        'remember_token',
        'id_role',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_pengguna');
    }
}
