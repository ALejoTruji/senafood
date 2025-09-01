<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notificacion
 * 
 * @property int $idNotificacion
 * @property string|null $mensaje
 * @property Carbon|null $fechaEnvio
 * @property int $idUsuario
 * @property int $idCarrito
 *
 * @package App\Models
 */
class Notificacion extends Model
{
	protected $table = 'notificacion';
	protected $primaryKey = 'idNotificacion';
	public $timestamps = false;

	protected $casts = [
		'fechaEnvio' => 'datetime',
		'idUsuario' => 'int',
		'idCarrito' => 'int'
	];

	protected $fillable = [
		'mensaje',
		'fechaEnvio',
		'idUsuario',
		'idCarrito'
	];
}
