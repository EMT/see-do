<?php

namespace App;

use App\Event;
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
    protected $fillable = [
        'title', 
        'slug', 
        'user_id',
        'color_scheme_id',
        'icon',
    ];


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

    public function eventCount() 
    {
        if (!isset($this->_eventCount)) {
            $this->_eventCount = Event::where('category_id', $this->id)->where('time_end', '>=', date('Y-m-d H:i:s'))->count();
        }

        return $this->_eventCount;
    }
}
