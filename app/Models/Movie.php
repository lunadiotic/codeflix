<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'director',
        'writers',
        'stars',
        'poster',
        'release_date',
        'duration',
        'url_720',
        'url_1080',
        'url_4k',
    ];

    protected $appends = ['average_rating'];

    protected $casts = [
        'release_date' => 'date',
    ];

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function ratings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function getAverageRatingAttribute(): float
    {
        return $this->ratings()->avg('rating');
    }

    public function getStreamingUrl(string $planResolution): string
    {
        return match ($planResolution) {
            '720p' => $this->url_720,
            '1080p' => $this->url_1080,
            '4k' => $this->url_4k,
            default => $this->url_720,
        };
    }

    public function getFormattedDurationAttribute()
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;
        $formatted = '';
        if ($hours > 0) {
            $formatted .= "{$hours}h ";
        }
        if ($minutes > 0 || $hours == 0) {
            $formatted .= "{$minutes}m";
        }
        return trim($formatted);
    }
}
