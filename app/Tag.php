<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
	protected $fillable = ['name','slug'];

    public function posts()
    {
    	return $this->morphedByMany(Post::class, 'taggable');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }
}
