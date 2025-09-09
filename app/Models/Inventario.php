<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Inventario
 * 
 * @property int $idInventario
 * @property string|null $nombre
 * @property int|null $idproducto
 * @property string|null $ubicacion
 * @property int|null $stockTotal
 * @property float|null $costouni
 * @property float|null $valor_total
 * @property int $capacidad_maxima
 * @property int $alerta_minimos
 * @property string|null $responsable
 * @property Carbon|null $ultima_revision
 * @property string|null $observaciones
 * @property int|null $usuario_ultima_actualizacion
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 * 
 * @property Collection|Auditorium[] $auditoria
 * @property Collection|MovimientosInventario[] $movimientos_inventarios
 * @property Collection|Producto[] $productos
 *
 * @package App\Models
 */
class Inventario extends Model
{
	protected $table = 'inventario';
	protected $primaryKey = 'idInventario';
	public $timestamps = false;

	protected $casts = [
		'idproducto' => 'int',
		'stockTotal' => 'int',
		'costouni' => 'float',
		'valor_total' => 'float',
		'capacidad_maxima' => 'int',
		'alerta_minimos' => 'int',
		'ultima_revision' => 'datetime',
		'usuario_ultima_actualizacion' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'nombre',
		'idproducto',
		'ubicacion',
		'stockTotal',
		'costouni',
		'valor_total',
		'capacidad_maxima',
		'alerta_minimos',
		'responsable',
		'ultima_revision',
		'observaciones',
		'usuario_ultima_actualizacion',
		'create_at',
		'update_at'
	];

	public function auditoria()
	{
		return $this->hasMany(Auditorium::class, 'idInventario');
	}

	public function movimientos_inventarios()
	{
		return $this->hasMany(MovimientosInventario::class, 'idInventario');
	}

	public function productos()
	{
		return $this->hasMany(Producto::class, 'idInventario');
	}
}
