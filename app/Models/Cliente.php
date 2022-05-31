<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $casts = [
        'fnacimiento' => 'datetime:Y-m-d',
    ];

    protected $fillable = [
        'dni',
        'nombre',
        'fnacimiento',
    ];

    /**
     * The cuentas that belong to the Cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cuentas()
    {
        return $this->belongsToMany(Cuenta::class, 'titulares');
    }
}
