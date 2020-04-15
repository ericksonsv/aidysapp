<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function abilities()
    {
        return $this->belongsToMany(Ability::class)->withTimestamps();
    }

    public function roleAbilities()
    {
        return $this->role->abilities->pluck('name');
    }

    public function directAbilities()
    {
        return $this->abilities->pluck('name');
    }

    public function assignDirectAbility($ability)
    {
        if (is_string($ability)) {
            $ability = Ability::whereName($ability)->firstOrFail();
        }

        if (is_integer($ability)) {
            $ability = Ability::whereId($ability)->firstOrFail();
        }

        $this->abilities()->syncWithoutDetaching($ability);
    }

    public function removeDirectAbility($ability)
    {
        if (is_string($ability)) {
            $ability = Ability::whereName($ability)->firstOrFail();
        }

        if (is_integer($ability)) {
            $ability = Ability::whereId($ability)->firstOrFail();
        }

        $this->abilities()->detach($ability);
    }

    public function getRoleNameAttribute()
    {
        return ($this->role->label) ? $this->role->label : Str::title(str_replace('-', ' ', $this->role->name));
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
