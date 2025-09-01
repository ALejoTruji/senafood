<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Auditorium
 * 
 * @property int $idAuditoria
 * @property Carbon|null $fecha
 * @property string|null $accion
 * @property int $idUsuario
 * @property int|null $idInventario
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Usuario $usuario
 * @property Inventario|null $inventario
 *
 * @package App\Models
 */
class Auditorium extends Model
{
	protected $table = 'auditoria';
	protected $primaryKey = 'idAuditoria';
	public $timestamps = false;

	protected $casts = [
		'fecha' => 'datetime',
		'idUsuario' => 'int',
		'idInventario' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'fecha',
		'accion',
		'idUsuario',
		'idInventario',
		'create_at',
		'update_at'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idUsuario');
	}

	public function inventario()
	{
		return $this->belongsTo(Inventario::class, 'idInventario');
	}
}
