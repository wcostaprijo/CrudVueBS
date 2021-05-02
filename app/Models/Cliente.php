<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_cliente';
    protected $dates = ['dt_nasc_cliente'];
    protected $guarded = ['id'];

    public function getDtNascClienteAttribute($value)
    {
        return now()->parse($value)->format('d/m/Y');
    }

    public function getCreatedAtAttribute($value)
    {
        return now()->parse($value)->format('d/m/Y');
    }
}
