<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devices extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_name',
        'operating_system',
        'ip_address',
        'depart_id',
        'category_id',
        'details'
    ];
    public function category()
    {
        return $this->belongsTo(category::class);
    }
    public function depart(){
        return $this->belongsTo(department::class);
    }
    public function maintenances()
    {
        return $this->hasMany(maintenance::class);
    }


    // Updated for Test

}
