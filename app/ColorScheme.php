<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorScheme extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'color_1',
        'color_2',
        'color_3',
    ];

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
