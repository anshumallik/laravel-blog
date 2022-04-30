<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Blog extends Model implements Searchable
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'user_id', 'slug', 'status', 'date', 'image'];

    public function categories()
    {
        return $this->belongsToMany("App\Models\Category", "blog_category");
    }
    public function tags()
    {
        return $this->belongsToMany("App\Models\Tag", "blog_tag");
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function getImg($img)
    {
        if ($img != null && $img != "default.png") {
            return asset("images/admin/blog/" . $img);
        }
        return asset("images/default.png");
    }
    public function getSearchResult(): SearchResult
    {
        $url = route('frontend.blog', ['slug' => $this->slug]);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
