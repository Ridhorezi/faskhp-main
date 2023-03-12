<?php

namespace App\Models;

use Database\Factories\UsahaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Usaha extends Model
{
    use HasFactory;
    use HasSlug;
    use Searchable;

    protected $fillable = [
        'user_id',
        'name',
        'jenis_kelamin',
        'jenis_usaha',
        'alamat_usaha',
        'tahun_usaha',
        'gambar',
        'dibuat',
    ];

    #[SearchUsingFullText(['name', 'jenis_usaha', 'alamat_usaha'])]
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'jenis_usaha' => $this->jenis_usaha,
            'alamat_usaha' => $this->alamat_usaha,
            'dibuat' => $this->dibuat,
        ];
    }

    /**
     * Scope a query to shows user without request or user with approved request.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCleanRequest($query)
    {
        return $query
            ->with('request')
            ->where('dibuat', 1)
            ->orWhereHas('request', function ($q) {
                return $q->accepted();
            });
    }

    public function request()
    {
        return $this->hasMany(Request::class, 'relasi_id', 'id')
            ->where('status', 'accepted')
            ->where('table_type', 'Usaha');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function newFactory()
    {
        return UsahaFactory::new();
    }
}
