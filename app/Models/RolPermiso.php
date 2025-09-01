<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RolPermiso
 * 
 * @property int $id_rol_permisorol
 * @property int $idRol
 * @property int $idPermiso
 * 
 * @property Rol $rol
 * @property Permiso $permiso
 *
 * @package App\Models
 */
class RolPermiso extends Model
{
	protected $table = 'rol_permiso';
	protected $primaryKey = 'id_rol_permisorol';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_rol_permisorol' => 'int',
		'idRol' => 'int',
		'idPermiso' => 'int'
	];

	protected $fillable = [
		'idRol',
		'idPermiso'
	];

	public function rol()
	{
		return $this->belongsTo(Rol::class, 'idRol');
	}

	public function permiso()
	{
		return $this->belongsTo(Permiso::class, 'idPermiso');
	}
}
