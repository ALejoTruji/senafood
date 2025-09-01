<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VCalificacion
 * 
 * @property string $nombre
 * @property string $apellido
 * @property string $nombre_producto
 * @property int|null $puntuacion
 * @property string|null $comentario
 *
 * @package App\Models
 */
class VCalificacion extends Model
{
	protected $table = 'v_calificacion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'puntuacion' => 'int'
	];

	protected $fillable = [
		'nombre',
		'apellido',
		'nombre_producto',
		'puntuacion',
		'comentario'
	];
}
