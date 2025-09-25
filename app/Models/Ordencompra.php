<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    use HasFactory;

    protected $table = 'ordencompra'; // Nombre de la tabla
    protected $primaryKey = 'id';     // 👈 Indicar que la PK es "id"

    protected $fillable = [
        'idProveedor',
        'idProducto',
        'fecha',
        'estado',
        'cantidad',
        'precioUnitario',
        'total'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'idProveedor');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }
    
    public function getRouteKeyName()
    {
        return 'id';
    }
}