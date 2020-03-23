<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
	protected $guarded = [];
	
    public function abilities()
    {
    	return $this->belongsToMany(Ability::class)->withTimestamps();
    }

    public function users()
    {
    	return $this->hasMany(User::class);
    }

    public function allowTo($ability)
    {
    	if (is_string($ability)) {
            $ability = Ability::whereName($ability)->firstOrFail();
        }

        if (is_integer($ability)) {
            $ability = Ability::whereId($ability)->firstOrFail();
        }

        $this->abilities()->syncWithoutDetaching($ability);
    }

    public function disallowTo($ability)
    {
    	if (is_string($ability)) {
            $ability = Ability::whereName($ability)->firstOrFail();
        }

        if (is_integer($ability)) {
            $ability = Ability::whereId($ability)->firstOrFail();
        }

        $this->abilities()->detach($ability);
    }

    public function getRoleLabelAttribute()
    {
        if ($this->label) {
            return $this->label;
        } else {
            return Str::title(str_replace('-', ' ', $this->name));
        }
    }
}