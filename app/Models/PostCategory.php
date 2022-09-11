<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PostCategory extends Pivot
{
    protected $fillable = [
        'user_id',
        'post_id',
    ];
}