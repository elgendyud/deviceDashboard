<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maintenance extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'device_id',
        'new_supply',
        'report'    
    ];

    // relation between maintenance and User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function device()
    {
        return $this->belongsTo(devices::class);
    }


    // Updated for test
    public function devices()
    {
        return $this->belongsTo(devices::class,'device_id');
    }


    public function supply()
    {
        return $this->belongsTo(Supply::class, 'new_supply'); // 'new_supply' is the foreign key in the maintenance table
    }
}
