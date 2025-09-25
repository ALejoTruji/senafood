<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificacion'; // 👈 nombre real de la tabla
    protected $primaryKey = 'idNotificacion';
    public $timestamps = false;

    protected $casts = [
        'fecha_envio' => 'datetime',
        'fechaLeida'  => 'datetime',
        'idUsuario'   => 'int',
        'idCarrito'   => 'int',
        'leida'       => 'boolean',
    ];

    protected $fillable = [
        'mensaje',
        'fecha_envio',
        'idUsuario',
        'idCarrito',
        'leida',
        'fechaLeida',
    ];

    protected static function booted()
    {
        static::creating(function ($notificacion) {
            if (empty($notificacion->fecha_envio)) {
                $notificacion->fecha_envio = now();
            }
        });
    }

    // 🔹 Relación con Carrito
    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'idCarrito', 'idCarrito');
    }

    // 🔹 Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'id');
    }
}
