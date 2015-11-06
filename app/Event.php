<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use App\Helpers\Markdown\MarkdownInterface;
use App\Helpers\Markdown\MarkdownTrait;
use Illuminate\Database\Eloquent\Model;

class Event extends Model implements SluggableInterface, 
                                     MarkdownInterface
{
    use SluggableTrait;
    use MarkdownTrait;

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

    public function longDates()
    {
        $dates = date('j', strtotime($this->time_start));

        if (date('y', strtotime($this->time_start)) !== date('y', strtotime($this->time_end))) {
            $dates .= date('.n.y—', strtotime($this->time_start)).date('j.n.y', strtotime($this->time_end));
        } elseif (date('n', strtotime($this->time_start)) !== date('n', strtotime($this->time_end))) {
            $dates .= date('.n—', strtotime($this->time_start)).date('j.n', strtotime($this->time_end));
        } elseif (date('d', strtotime($this->time_start)) !== date('d', strtotime($this->time_end))) {
            $dates .= date('—j.n.Y', strtotime($this->time_end));
        } else {
            $dates .= date('.n.Y', strtotime($this->time_end));
        }

        return $dates;
    }

    public function shortDates()
    {
        $dates = date('j', strtotime($this->time_start));

        if (date('y', strtotime($this->time_start)) !== date('y', strtotime($this->time_end))) {
            $dates .= date('.n.y—', strtotime($this->time_start)).date('j.n.y', strtotime($this->time_end));
        } elseif (date('n', strtotime($this->time_start)) !== date('n', strtotime($this->time_end))) {
            $dates .= date('.n—', strtotime($this->time_start)).date('j.n', strtotime($this->time_end));
        } elseif (date('d', strtotime($this->time_start)) !== date('d', strtotime($this->time_end))) {
            $dates .= date('—j', strtotime($this->time_end));
        }

        return $dates;
    }

    public function times()
    {
        $times = date('g.i', strtotime($this->time_start));

        if (date('g.i', strtotime($this->time_start)) !== date('g.ia', strtotime($this->time_end))) {
            if (date('a', strtotime($this->time_start)) !== date('a', strtotime($this->time_end))) {
                $times .= date('a—', strtotime($this->time_start)).date('g.ia', strtotime($this->time_end));
            } else {
                $times .= date('—g.ia', strtotime($this->time_end));
            }
        } else {
            $times .= date('a', strtotime($this->time_end));
        }

        return $times;
    }

    /**
     * Returns all events in with time_end in the future.
     *
     * @return Collection A collection of Events
     */
    public static function futureEvents()
    {
        return self::where('time_end', '>=', date('Y-m-d H:i:s'))->orderBy('time_start', 'asc')->get();
    }
}
