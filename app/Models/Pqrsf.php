<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pqrsf
 * 
 * @property int $idPQRSF
 * @property string|null $tipo
 * @property string|null $descripcion
 * @property string|null $estado
 * @property int $idUsuario
 * @property int $idCarrito
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Usuario $usuario
 * @property Carrito $carrito
 *
 * @package App\Models
 */
class Pqrsf extends Model
{
	protected $table = 'pqrsf';
	protected $primaryKey = 'idPQRSF';
	public $timestamps = false;

	protected $casts = [
		'idUsuario' => 'int',
		'idCarrito' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'tipo',
		'descripcion',
		'estado',
		'idUsuario',
		'idCarrito',
		'create_at',
		'update_at'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idUsuario');
	}

	public function carrito()
	{
		return $this->belongsTo(Carrito::class, 'idCarrito');
	}
}
