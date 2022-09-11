<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drafts extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'data',
        'model_id',
        'user_id',
    ];

    public function origin(){
        $model = app($this->model);
        return $this->belongsTo($model);
    }
}
