<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'svg',
        'title',
    ];

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
