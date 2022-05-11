<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = 'movimientos';

    protected $casts = [
        'fecha' => 'datetime:Y-m-d',
    ];

    protected $fillable = [
        'cuenta_id',
        'fecha',
        'concepto',
        'importe',
    ];

    /**
     * Get the cuenta that owns the Movimiento
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class);
    }
}
