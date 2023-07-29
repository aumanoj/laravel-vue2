<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandContent extends Model
{
    use HasFactory;

    const CREATED_AT = null;
    const UPDATED_AT = 'modified';

    
    protected $fillable=[
        'manu_id','model_id','madel_num','description','meta_title','meta_keyword','meta_desc','heading_title','backtracklinks','instruction_url'
        
    ];
}
