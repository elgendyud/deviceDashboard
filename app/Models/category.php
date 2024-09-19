<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name'
    ];

    
    public function device()
    {
        return $this->hasMany(devices::class);
    }
}
