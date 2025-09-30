<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificacion'; // 👈 nombre real de la tabla
    protected $primaryKey = 'idNotificacion';
    public $timestamps = true; // 👈 ahora Laravel manejará created_at y updated_at

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
        'idPQRSF',
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

    //Metodopara ver pqrsf desde notificacion
    public function pqrsf()
    {
        return $this->belongsTo(\App\Models\Pqrsf::class, 'idPQRSF', 'idPQRSF');
    }
    }
