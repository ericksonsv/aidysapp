<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
	protected $guarded = [];
	
    public function roles()
    {
    	return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function users()
    {
    	return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function assignToRole($role)
    {
    	return $this->roles()->save($role);
    }

    public function removeToRole($role)
    {
    	return $this->roles()->delete($role);
    }

    public function assignToUser($user)
    {
    	return $this->users()->save($user);
    }

    public function removeToUser($user)
    {
    	return $this->users()->delete($user);
    }

    public function getAbilityLabelAttribute()
    {
        if ($this->label) {
            return $this->label;
        } else {
            return Str::title(str_replace('-', ' ', $this->name));
        }
    }
}
