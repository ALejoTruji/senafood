<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Proveedor
 * 
 * @property int $idProveedor
 * @property string|null $nombre
 * @property string|null $contacto
 * @property string|null $telefono
 * @property string|null $direccion
 * @property string|null $NIT
 * @property Carbon|null $update_at
 * @property Carbon|null $create_at
 * 
 * @property Collection|Ordencompra[] $ordencompras
 *
 * @package App\Models
 */
class Proveedor extends Model
{
	protected $table = 'proveedor';
	protected $primaryKey = 'idProveedor';
	public $timestamps = false;

	protected $casts = [
		'update_at' => 'datetime',
		'create_at' => 'datetime'
	];

	protected $fillable = [
		'nombre',
		'contacto',
		'telefono',
		'direccion',
		'NIT',
		'update_at',
		'create_at'
	];

	public function ordencompras()
	{
		return $this->hasMany(Ordencompra::class, 'idProveedor');
	}
}
