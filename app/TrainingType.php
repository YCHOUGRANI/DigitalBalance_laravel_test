<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingType extends Model
{
    protected $fillable = ['id','name'];

    public function training()
    {
         return $this->belongsTo('App\Training');
    }
}
