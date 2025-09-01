<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Promocion
 * 
 * @property int $idPromocion
 * @property string|null $descripcion
 * @property float|null $descuento
 * @property int $idProducto
 * @property Carbon|null $update_at
 * @property Carbon|null $create_at
 * 
 * @property Producto $producto
 *
 * @package App\Models
 */
class Promocion extends Model
{
	protected $table = 'promocion';
	protected $primaryKey = 'idPromocion';
	public $timestamps = false;

	protected $casts = [
		'descuento' => 'float',
		'idProducto' => 'int',
		'update_at' => 'datetime',
		'create_at' => 'datetime'
	];

	protected $fillable = [
		'descripcion',
		'descuento',
		'idProducto',
		'update_at',
		'create_at'
	];

	public function producto()
	{
		return $this->belongsTo(Producto::class, 'idProducto');
	}
}
