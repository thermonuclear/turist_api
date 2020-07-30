<?php

namespace App\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
