<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'tags',
        'is_published',
        'published_at',
        'user_id',
        'meta_description',
        'meta_keywords',
        'reading_time',
        'views_count'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views_count' => 'integer'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = static::generateUniqueSlug($article->title);
            }

            // Calculate reading time
            $article->reading_time = static::calculateReadingTime($article->content);
        });

        static::updating(function ($article) {
            // Recalculate reading time if content changed
            if ($article->isDirty('content')) {
                $article->reading_time = static::calculateReadingTime($article->content);
            }
        });
    }

    /**
     * Get the user that owns the article.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include published articles.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include draft articles.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDraft($query)
    {
        return $query->where('is_published', false);
    }

    /**
     * Scope a query to filter by category.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope a query to filter by tag.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $tag
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithTag($query, $tag)
    {
        return $query->whereJsonContains('tags', $tag);
    }

    /**
     * Scope a query to search articles.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('content', 'like', "%{$term}%")
              ->orWhere('excerpt', 'like', "%{$term}%")
              ->orWhere('category', 'like', "%{$term}%");
        });
    }

    /**
     * Get the article's full featured image URL.
     *
     * @return string|null
     */
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }

        return null;
    }

    /**
     * Get the article's excerpt or truncated content.
     *
     * @return string
     */
    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }

        return Str::limit(strip_tags($this->content), 150);
    }

    /**
     * Get the article's reading time in minutes.
     *
     * @return int
     */
    public function getReadingTimeAttribute($value)
    {
        return $value ?: static::calculateReadingTime($this->content);
    }

    /**
     * Get the article's tags as a comma-separated string.
     *
     * @return string
     */
    public function getTagsStringAttribute()
    {
        if ($this->tags && is_array($this->tags)) {
            return implode(', ', $this->tags);
        }

        return '';
    }

    /**
     * Get formatted published date.
     *
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        if ($this->published_at) {
            return $this->published_at->format('d M Y');
        }

        return $this->created_at->format('d M Y');
    }

    /**
     * Get human readable published date.
     *
     * @return string
     */
    public function getHumanDateAttribute()
    {
        if ($this->published_at) {
            return $this->published_at->diffForHumans();
        }

        return $this->created_at->diffForHumans();
    }

    /**
     * Increment views count.
     *
     * @return void
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Generate a unique slug for the given title.
     *
     * @param  string  $title
     * @param  int|null  $excludeId
     * @return string
     */
    public static function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (true) {
            $query = static::where('slug', $slug);

            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            if (!$query->exists()) {
                break;
            }

            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Calculate reading time based on content.
     *
     * @param  string  $content
     * @return int
     */
    public static function calculateReadingTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        $readingTime = ceil($wordCount / 200); // Average reading speed: 200 words per minute

        return max(1, $readingTime); // Minimum 1 minute
    }

    /**
     * Get related articles.
     *
     * @param  int  $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedArticles($limit = 3)
    {
        return static::published()
                    ->where('id', '!=', $this->id)
                    ->where('category', $this->category)
                    ->latest('published_at')
                    ->take($limit)
                    ->get();
    }

    /**
     * Get popular articles.
     *
     * @param  int  $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getPopular($limit = 5)
    {
        return static::published()
                    ->orderBy('views_count', 'desc')
                    ->take($limit)
                    ->get();
    }
}
