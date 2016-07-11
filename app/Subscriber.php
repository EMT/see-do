<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscriber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'token',
    ];

    public function getRouteKeyName()
    {
        return 'token';
    }

    public function createNewToken()
    {
        $this->token = hash_hmac('sha256', $this->id + '/' + Str::random(40), config('app.key'));
        $this->save();

        return $this->token;
    }
}
