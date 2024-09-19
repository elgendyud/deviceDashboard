<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    use HasFactory;
    protected $fillable = [
        'depart_name',
        'quantity'
    ];
    public function device()
    {
        return $this->hasMany(devices::class);
    }
}
