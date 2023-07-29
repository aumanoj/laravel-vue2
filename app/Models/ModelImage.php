<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelImage extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable=[
        'model_id','image_name',
        
    ];
}
