<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permiso
 * 
 * @property int $idPermiso
 * @property string $nombrePermiso
 * 
 * @property Collection|Rol[] $rols
 *
 * @package App\Models
 */
class Permiso extends Model
{
	protected $table = 'permiso';
	protected $primaryKey = 'idPermiso';
	public $timestamps = false;

	protected $fillable = [
		'nombrePermiso'
	];

	public function rols()
	{
		return $this->belongsToMany(Rol::class, 'rol_permiso', 'idPermiso', 'idRol')
					->withPivot('id_rol_permisorol');
	}
}
