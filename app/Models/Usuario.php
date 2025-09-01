<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property int $idUsuario
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $contraseña
 * @property string|null $telefono
 * @property string|null $tipoIdentificacion
 * @property string|null $numeroIdentificacion
 * @property int $idRol
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Rol $rol
 * @property Collection|Auditorium[] $auditoria
 * @property Collection|Calificacion[] $calificacions
 * @property Collection|Fidelizacion[] $fidelizacions
 * @property Collection|HistorialUsuario[] $historial_usuarios
 * @property Collection|MovimientosInventario[] $movimientos_inventarios
 * @property Collection|Ordencompra[] $ordencompras
 * @property Collection|Pqrsf[] $pqrsfs
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuario';
	protected $primaryKey = 'idUsuario';
	public $timestamps = false;

	protected $casts = [
		'idRol' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'nombre',
		'apellido',
		'email',
		'contraseña',
		'telefono',
		'tipoIdentificacion',
		'numeroIdentificacion',
		'idRol',
		'create_at',
		'update_at'
	];

	public function rol()
	{
		return $this->belongsTo(Rol::class, 'idRol');
	}

	public function auditoria()
	{
		return $this->hasMany(Auditorium::class, 'idUsuario');
	}

	public function calificacions()
	{
		return $this->hasMany(Calificacion::class, 'idUsuario');
	}

	public function fidelizacions()
	{
		return $this->hasMany(Fidelizacion::class, 'idUsuario');
	}

	public function historial_usuarios()
	{
		return $this->hasMany(HistorialUsuario::class, 'idUsuario');
	}

	public function movimientos_inventarios()
	{
		return $this->hasMany(MovimientosInventario::class);
	}

	public function ordencompras()
	{
		return $this->hasMany(Ordencompra::class, 'idUsuario');
	}

	public function pqrsfs()
	{
		return $this->hasMany(Pqrsf::class, 'idUsuario');
	}
}
