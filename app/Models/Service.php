<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'icon',
        'price',
        'duration',
        'is_active',
        'sort_order',
        'image_path',
        'category',
        'features',
        'requirements',
        'benefits'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'features' => 'array',
        'requirements' => 'array',
        'benefits' => 'array',
        'duration' => 'integer'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Scope a query to only include active services.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order services by sort_order and name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
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
     * Scope a query to search services.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%")
              ->orWhere('category', 'like', "%{$term}%");
        });
    }

    /**
     * Get the service's full image URL.
     *
     * @return string|null
     */
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }

        return null;
    }

    /**
     * Get formatted price.
     *
     * @return string
     */
    public function getFormattedPriceAttribute()
    {
        if ($this->price) {
            return '฿' . number_format($this->price);
        }

        return 'ปรึกษาเพื่อทราบราคา';
    }

    /**
     * Get formatted duration.
     *
     * @return string
     */
    public function getFormattedDurationAttribute()
    {
        if ($this->duration) {
            $hours = floor($this->duration / 60);
            $minutes = $this->duration % 60;

            if ($hours > 0 && $minutes > 0) {
                return "{$hours} ชั่วโมง {$minutes} นาที";
            } elseif ($hours > 0) {
                return "{$hours} ชั่วโมง";
            } else {
                return "{$minutes} นาที";
            }
        }

        return 'ระยะเวลาไม่ระบุ';
    }

    /**
     * Get the service's features as a formatted string.
     *
     * @return string
     */
    public function getFeaturesStringAttribute()
    {
        if ($this->features && is_array($this->features)) {
            return implode(', ', $this->features);
        }

        return '';
    }

    /**
     * Get the service's requirements as a formatted string.
     *
     * @return string
     */
    public function getRequirementsStringAttribute()
    {
        if ($this->requirements && is_array($this->requirements)) {
            return implode(', ', $this->requirements);
        }

        return '';
    }

    /**
     * Get the service's benefits as a formatted string.
     *
     * @return string
     */
    public function getBenefitsStringAttribute()
    {
        if ($this->benefits && is_array($this->benefits)) {
            return implode(', ', $this->benefits);
        }

        return '';
    }

    /**
     * Get the default icon for the service.
     *
     * @return string
     */
    public function getDefaultIconAttribute()
    {
        return $this->icon ?: 'fas fa-stethoscope';
    }

    /**
     * Get popular services.
     *
     * @param  int  $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getPopular($limit = 6)
    {
        return static::active()
                    ->ordered()
                    ->take($limit)
                    ->get();
    }

    /**
     * Get services by category.
     *
     * @param  string  $category
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getByCategory($category)
    {
        return static::active()
                    ->inCategory($category)
                    ->ordered()
                    ->get();
    }
}
