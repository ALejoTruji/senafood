<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ordencompra
 * 
 * @property int $idOrden
 * @property Carbon|null $fecha
 * @property string|null $estado
 * @property int $idProveedor
 * @property int $idUsuario
 * @property string|null $producto
 * @property int|null $cantidad
 * @property float|null $precioUnitario
 * @property float|null $total
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Usuario $usuario
 * @property Proveedor $proveedor
 *
 * @package App\Models
 */
class Ordencompra extends Model
{
	protected $table = 'ordencompra';
	protected $primaryKey = 'idOrden';
	public $timestamps = false;

	protected $casts = [
		'fecha' => 'datetime',
		'idProveedor' => 'int',
		'idUsuario' => 'int',
		'cantidad' => 'int',
		'precioUnitario' => 'float',
		'total' => 'float',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'fecha',
		'estado',
		'idProveedor',
		'idUsuario',
		'producto',
		'cantidad',
		'precioUnitario',
		'total',
		'create_at',
		'update_at'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idUsuario');
	}

	public function proveedor()
	{
		return $this->belongsTo(Proveedor::class, 'idProveedor');
	}
}
