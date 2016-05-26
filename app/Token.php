<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Token extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token',
    ];


    public function createNewToken(City $city)
    {
        $this->token = hash_hmac('sha256', Str::random(40), config('app.key'));
        $this->city_id = $city->id;
        $this->save();

        return $this->token;
    }
}
