<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderComment extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'created_by';
    

    protected $fillable = [
		'order_id','comment'
	];
}
