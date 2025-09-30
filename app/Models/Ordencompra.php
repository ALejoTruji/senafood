<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordencompra extends Model
{
    use HasFactory;

    // ✅ CORREGIDO: La tabla se llama 'ordencompra' en singular
    protected $table = 'ordencompra';
    
    protected $primaryKey = 'idOrden';

    protected $fillable = [
        'fecha',
        'estado', 
        'idProveedor',
        'idUsuario',
        'idProducto',
        'cantidad',
        'precioUnitario',
        'total'
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'cantidad' => 'integer',
        'precioUnitario' => 'decimal:2',
        'total' => 'decimal:2'
    ];

    // ✅ CORREGIDO: Timestamps personalizados
    public $timestamps = false; // Desactivar timestamps automáticos
    
    // O si quieres usar los timestamps personalizados:
    // const CREATED_AT = 'create_at';
    // const UPDATED_AT = 'update_at';

    public function getRouteKeyName()
    {
        return 'idOrden';
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'idProveedor', 'idProveedor');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto', 'idProducto');
    }
}