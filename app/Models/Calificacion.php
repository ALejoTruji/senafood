<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Calificacion
 * 
 * @property int $idCalificacion
 * @property int|null $puntuacion
 * @property string|null $comentario
 * @property int $idUsuario
 * @property int $idProducto
 * @property int $idCarrito
 * 
 * @property Carrito $carrito
 * @property Usuario $usuario
 * @property Producto $producto
 *
 * @package App\Models
 */
class Calificacion extends Model
{
	protected $table = 'calificacion';
	protected $primaryKey = 'idCalificacion';
	public $timestamps = false;

	protected $casts = [
		'puntuacion' => 'int',
		'idUsuario' => 'int',
		'idProducto' => 'int',
		'idCarrito' => 'int'
	];

	protected $fillable = [
		'puntuacion',
		'comentario',
		'idUsuario',
		'idProducto',
		'idCarrito'
	];

	public function carrito()
	{
		return $this->belongsTo(Carrito::class, 'idCarrito');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idUsuario');
	}

	public function producto()
	{
		return $this->belongsTo(Producto::class, 'idProducto');
	}
}
