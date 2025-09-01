<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detallepedido
 * 
 * @property int $idDetalle
 * @property int $idCarrito
 * @property int $idProducto
 * @property int $cantidad
 * 
 * @property Carrito $carrito
 * @property Producto $producto
 *
 * @package App\Models
 */
class Detallepedido extends Model
{
	protected $table = 'detallepedido';
	protected $primaryKey = 'idDetalle';
	public $timestamps = false;

	protected $casts = [
		'idCarrito' => 'int',
		'idProducto' => 'int',
		'cantidad' => 'int'
	];

	protected $fillable = [
		'idCarrito',
		'idProducto',
		'cantidad'
	];

	public function carrito()
	{
		return $this->belongsTo(Carrito::class, 'idCarrito');
	}

	public function producto()
	{
		return $this->belongsTo(Producto::class, 'idProducto');
	}
}
