<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class posts extends Model
{
    use SoftDeletes;
    protected $fillable =[
        'title',
        'description',
        'content',
        'image',
    ];

}
