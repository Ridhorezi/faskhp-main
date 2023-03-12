<?php

namespace App\Models;

use Database\Factories\LokerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Loker extends Model
{
    use HasFactory;
    use Searchable;
    use HasSlug;
    protected $fillable = [
        'title',
        'qualification',
        'description',
        'contact',
    ];

    #[SearchUsingFullText(['title', 'qualification', 'description', 'contact'])]
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'qualification' => $this->qualification,
            'description' => $this->description,
            'contact' => $this->contact,
        ];
    }

    protected static function newFactory()
    {
        return LokerFactory::new();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
