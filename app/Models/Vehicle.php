<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'license_plate',
        'year',
        'price',
        'user_id',
    ];

    // Cuando se use el modelo, esos campos se traten como int
    protected $casts = [
        'year' => 'integer',
        'price' => 'integer',
        'user_id' => 'integer',
    ];

    // Vehiculo tiene dueños que son los users.

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
