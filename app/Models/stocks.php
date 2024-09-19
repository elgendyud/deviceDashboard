<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stocks extends Model
{
    use HasFactory;

    protected $fillable = [
        'supply_id',
        'quantity', // include other attributes as needed
        'supply_name',
    ];

    public function supplies()
    {
        return $this->hasMany(maintenance::class);
    }
}
