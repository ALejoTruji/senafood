<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordencompra extends Model
{
    protected $table = 'ordencompra';
    protected $primaryKey = 'idOrden';
    public $timestamps = false;

    protected $fillable = [
        'fecha', 'estado', 'idProveedor', 'idUsuario', 'producto',
        'cantidad', 'precioUnitario', 'total'
    ];

    public function getRouteKeyName()
    {
        return 'idOrden';
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'idProveedor');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto');
    }
}