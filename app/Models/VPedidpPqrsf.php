<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VPedidpPqrsf
 * 
 * @property string $nombre
 * @property string $apellido
 * @property string|null $tipo_pqrsf
 * @property string|null $descripcion_pqrsf
 * @property string|null $estado_pqrsf
 * @property string $nombre_producto
 * @property string|null $metodo_pago
 * @property Carbon|null $fecha_compra
 *
 * @package App\Models
 */
class VPedidpPqrsf extends Model
{
	protected $table = 'v_pedidp_pqrsf';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'fecha_compra' => 'datetime'
	];

	protected $fillable = [
		'nombre',
		'apellido',
		'tipo_pqrsf',
		'descripcion_pqrsf',
		'estado_pqrsf',
		'nombre_producto',
		'metodo_pago',
		'fecha_compra'
	];
}
