<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Carrito
 * 
 * @property int $idCarrito
 * @property int $idUsuario
 * @property float|null $total
 * @property string|null $estado
 * @property Carbon|null $fecha
 * @property string|null $metodoPago
 * @property string|null $numeroFactura
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Collection|Calificacion[] $calificacions
 * @property Collection|Detallecarrito[] $detallecarritos
 * @property Collection|Detallepedido[] $detallepedidos
 * @property Collection|Pqrsf[] $pqrsfs
 *
 * @package App\Models
 */
class Carrito extends Model
{
	protected $table = 'carrito';
	protected $primaryKey = 'idCarrito';
	public $timestamps = false;

	protected $casts = [
		'idUsuario' => 'int',
		'total' => 'float',
		'fecha' => 'datetime',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'idUsuario',
		'total',
		'estado',
		'fecha',
		'metodoPago',
		'numeroFactura',
		'create_at',
		'update_at'
	];

	public function calificacions()
	{
		return $this->hasMany(Calificacion::class, 'idCarrito');
	}

	public function detallecarritos()
	{
		return $this->hasMany(Detallecarrito::class, 'idCarrito');
	}

	public function detallepedidos()
	{
		return $this->hasMany(Detallepedido::class, 'idCarrito');
	}

	public function pqrsfs()
	{
		return $this->hasMany(Pqrsf::class, 'idCarrito');
	}
}
