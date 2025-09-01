<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rol
 * 
 * @property int $idRol
 * @property string $nombreRol
 * 
 * @property Collection|Permiso[] $permisos
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Rol extends Model
{
	protected $table = 'rol';
	protected $primaryKey = 'idRol';
	public $timestamps = false;

	protected $fillable = [
		'nombreRol'
	];

	public function permisos()
	{
		return $this->belongsToMany(Permiso::class, 'rol_permiso', 'idRol', 'idPermiso')
					->withPivot('id_rol_permisorol');
	}

	public function usuarios()
	{
		return $this->hasMany(Usuario::class, 'idRol');
	}
}
