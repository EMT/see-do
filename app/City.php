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

 	/**
     * Returns a city based on the iata
     *
     * @return A city
     */
    public static function findByIATA($iata)
    {
        return self::where('iata', '=', $iata);
    }

    public static function getIdfromIATA($iata) {
        return self::findByIATA($iata)->first()->id;
    }
}