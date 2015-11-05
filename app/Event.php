<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Event extends Model implements SluggableInterface
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
        'content',
        'time_start',
        'time_end',
        'venue',
        'slug',
        'user_id',
        'color_scheme_id',
        'icons',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function colorScheme()
    {
        return $this->belongsTo('App\ColorScheme');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function icons()
    {
        $icons = Icon::whereIn('id', $this->iconIdsArray())->get();
        $iconsList = Icon::where('id', 0)->get();

        foreach ($this->iconIdsArray() as $iconId) {
            $iconsList->push($icons->first(function ($key, $val) use ($iconId) {return (int) $val->id === (int) $iconId; }));
        }

        return $iconsList;
    }

    public function iconIdsArray()
    {
        $idsArray = explode(',', $this->icons);
        $idsArray = array_filter($idsArray, 'is_numeric');

        return (count($idsArray) && !empty($idsArray[0])) ? $idsArray : [];
    }

    public function iconTitlesArray()
    {
        $iconTitlesArray = [];

        foreach ($this->icons() as $icon) {
            $iconTitlesArray[] = $icon->title;
        }

        return $iconTitlesArray;
    }

   /**
    * Returns all events in with time_end in the future
    * @return Collection A collection of Events
    */
    public static function futureEvents() {
        return Event::where('time_end', '>=', date('Y-m-d H:i:s'))->orderBy('time_start', 'asc')->get();
    }
}
