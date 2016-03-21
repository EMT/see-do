<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'user_id',
        'name',
        'iata',
    ];

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    // public function categories()
    // {
    //     return $this->hasMany('App\Category');
    // }

    // public function user()
    // {
    //     return $this->belongsTo('App\User');
    // }
    //
 	/**
     * Returns all events in with time_end in the future.
     *
     * @return Collection A collection of Events
     */
    public static function findByIATA($iata)
    {
        return self::where('iata', '=', $iata);
    }
}