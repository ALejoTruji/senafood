<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Fidelizacion
 * 
 * @property int $idFidelizacion
 * @property int|null $puntos
 * @property string|null $nivel
 * @property int $idUsuario
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Fidelizacion extends Model
{
	protected $table = 'fidelizacion';
	protected $primaryKey = 'idFidelizacion';
	public $timestamps = false;

	protected $casts = [
		'puntos' => 'int',
		'idUsuario' => 'int'
	];

	protected $fillable = [
		'puntos',
		'nivel',
		'idUsuario'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idUsuario');
	}
}
