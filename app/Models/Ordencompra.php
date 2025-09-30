<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Ordencompra extends Model
{
    protected $table = 'ordencompra';
    protected $primaryKey = 'idOrden';
    public $timestamps = true; // Esto espera created_at y updated_at

    // Si usas create_at y update_at personalizados, cambia a:
    // public $timestamps = false;
    
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';

    protected $fillable = [
        'fecha', 'estado', 'idProveedor', 'idUsuario', 'producto',
        'cantidad', 'precioUnitario', 'total', 'create_at', 'update_at'
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'create_at' => 'datetime',
        'update_at' => 'datetime',
        'cantidad' => 'integer',
        'precioUnitario' => 'decimal:2',
        'total' => 'decimal:2'
    ];

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
        return $this->belongsTo(Producto::class, 'producto', 'idProducto');
    }
}