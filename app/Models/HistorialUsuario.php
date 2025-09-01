<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HistorialUsuario
 * 
 * @property int $idHistorial
 * @property int|null $idUsuario
 * @property string|null $campoModificado
 * @property string|null $valorAnterior
 * @property string|null $valorNuevo
 * @property Carbon $fechaCambio
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class HistorialUsuario extends Model
{
	protected $table = 'historial_usuario';
	protected $primaryKey = 'idHistorial';
	public $timestamps = false;

	protected $casts = [
		'idUsuario' => 'int',
		'fechaCambio' => 'datetime'
	];

	protected $fillable = [
		'idUsuario',
		'campoModificado',
		'valorAnterior',
		'valorNuevo',
		'fechaCambio'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idUsuario');
	}
}
