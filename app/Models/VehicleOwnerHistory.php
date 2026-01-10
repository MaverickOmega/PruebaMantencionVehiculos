<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleOwnerHistory extends Model
{
    protected $fillable = [
        'vehicle_id',
        'user_id',
        'assigned_at',
        'unassigned_at',
    ];

    // Cuando se use el modelo, esos campos se tratan como datetime
    protected $casts = [
        'assigned_at' => 'datetime',
        'unassigned_at' => 'datetime',
    ];
    public function vehicle(){
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}