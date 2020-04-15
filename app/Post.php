<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
	protected $fillable = [
		'user_id',
		'category_id',
		'title',
		'seo_title',
		'slug',
		'excerpt',
		'body',
		'image',
		'image_url',
		'video',
		'video_url',
		'meta_description',
		'meta_keywords',
		'status',
		'featured',
		'views',
	];

	public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
    	return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags()
    {
    	return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

	public function setSlugAttribute($value)
	{
		$slug = Str::slug($value);
		if (static::whereSlug($slug)->exists()) {
			$slug = $this->incrementSlug($slug);
		}
		$this->attributes['slug'] = $slug;
	}

	public function incrementSlug($slug)
	{
		$max = static::whereTitle($this->title)->latest('id')->value('slug');
		if (is_numeric($max[-1])) {
			return preg_replace_callback('/(\d+)$/', function ($matches){
				return $matches[1] + 1;
			}, $max);
		}
		return "{$slug}-2";
	}

}
