<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract,
                                    SluggableInterface,
                                    HasRoleAndPermissionContract
{
    use Authenticatable, Authorizable, CanResetPassword, SluggableTrait, HasRoleAndPermission {
        Authorizable::can insteadof HasRoleAndPermission;
        HasRoleAndPermission::can as may;
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_first',
        'name_last',
        'username',
        'email',
        'password',
        'bio',
        'city_id',
    ];

    protected $sluggable = [
        'build_from' => 'username',
        'save_to'    => 'slug',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function city() {
        return $this->belongsTo('App\City');
    }

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function colorSchemes()
    {
        return $this->hasMany('App\ColorScheme');
    }
}
