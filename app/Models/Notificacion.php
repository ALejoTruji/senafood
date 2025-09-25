<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // 👈 importa el modelo User

/**
 * Class Notificacion
 * 
 * @property int $idNotificacion
 * @property string|null $mensaje
 * @property Carbon|null $fechaEnvio
 * @property int $idUsuario
 * @property int $idCarrito
 *
 * @package App\Models
 */
class Notificacion extends Model
{
	protected $table = 'notificacion';
	protected $primaryKey = 'idNotificacion';
	public $timestamps = false;

	protected $casts = [
		'fechaEnvio' => 'datetime',
		'idUsuario' => 'int',
		'idCarrito' => 'int'
	];

<<<<<<< juanse
	protected $fillable = [
		'mensaje',
		'fechaEnvio',
		'idUsuario',
		'idCarrito'
	];
=======
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

    // 🔹 Relación con Usuario (para mostrar nombre del usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'id');
    }
>>>>>>> local
}
