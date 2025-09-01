<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MovimientosInventario
 * 
 * @property int $idMovimiento
 * @property int $idProducto
 * @property int $idInventario
 * @property string $tipo_movimiento
 * @property int $cantidad
 * @property Carbon|null $fecha_movimiento
 * @property int $usuario_id
 * @property string|null $observaciones
 * 
 * @property Producto $producto
 * @property Inventario $inventario
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class MovimientosInventario extends Model
{
	protected $table = 'movimientos_inventario';
	protected $primaryKey = 'idMovimiento';
	public $timestamps = false;

	protected $casts = [
		'idProducto' => 'int',
		'idInventario' => 'int',
		'cantidad' => 'int',
		'fecha_movimiento' => 'datetime',
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'idProducto',
		'idInventario',
		'tipo_movimiento',
		'cantidad',
		'fecha_movimiento',
		'usuario_id',
		'observaciones'
	];

	public function producto()
	{
		return $this->belongsTo(Producto::class, 'idProducto');
	}

	public function inventario()
	{
		return $this->belongsTo(Inventario::class, 'idInventario');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}
