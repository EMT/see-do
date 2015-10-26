<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Category extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'color_scheme_id'];


    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function colorScheme()
    {
        return $this->belongsTo('App\ColorScheme');
    }
}