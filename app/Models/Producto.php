<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property int $idProducto
 * @property string $nombre
 * @property string|null $descripcion
 * @property float $costo_unitario
 * @property int $stock
 * @property int $idInventario
 * @property Carbon $fecha_vencimiento
 * @property string $categoria
 * @property string|null $codigo_barras
 * @property string $estado
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 *
 * @property Inventario $inventario
 * @property Collection|Calificacion[] $calificacions
 * @property Collection|Detallecarrito[] $detallecarritos
 * @property Collection|Detallepedido[] $detallepedidos
 * @property Collection|MovimientosInventario[] $movimientos_inventarios
 * @property Collection|Promocion[] $promocions
 *
 * @package App\Models
 */
class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'idProducto';
    public $timestamps = false; // porque ya usas create_at y update_at personalizados

    protected $casts = [
        'costo_unitario' => 'float',
        'stock' => 'int',
        'idInventario' => 'int',
        'fecha_vencimiento' => 'datetime',
        'create_at' => 'datetime',
        'update_at' => 'datetime',
    ];

    protected $fillable = [
        'nombre',
        'descripcion',
        'costo_unitario',
        'stock',
        'idInventario',
        'fecha_vencimiento',
        'categoria',
        'codigo_barras',
        'estado',
        'create_at',
        'update_at',
    ];

    // 🔗 Relación: un producto pertenece a un inventario
    public function inventario()
    {
        return $this->belongsTo(Inventario::class, 'idInventario');
    }

    public function calificacions()
    {
        return $this->hasMany(Calificacion::class, 'idProducto');
    }

    public function detallecarritos()
    {
        return $this->hasMany(Detallecarrito::class, 'idProducto');
    }

    public function detallepedidos()
    {
        return $this->hasMany(Detallepedido::class, 'idProducto');
    }

    public function movimientos_inventarios()
    {
        return $this->hasMany(MovimientosInventario::class, 'idProducto');
    }

    public function promocions()
    {
        return $this->hasMany(Promocion::class, 'idProducto');
    }
}
