<?php

namespace App\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
