<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'specialization',
        'description',
        'image_path',
        'education',
        'experience',
        'languages',
        'is_active',
        'sort_order',
        'phone',
        'email',
        'consultation_fee',
        'available_days',
        'available_hours'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'languages' => 'array',
        'is_active' => 'boolean',
        'available_days' => 'array',
        'consultation_fee' => 'decimal:2'
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
     * Scope a query to only include active doctors.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order doctors by sort_order and name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Scope a query to filter by specialization.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $specialization
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBySpecialization($query, $specialization)
    {
        return $query->where('specialization', 'like', "%{$specialization}%");
    }

    /**
     * Get the doctor's full image URL.
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
     * Get the doctor's languages as a formatted string.
     *
     * @return string
     */
    public function getLanguagesStringAttribute()
    {
        if ($this->languages && is_array($this->languages)) {
            return implode(', ', $this->languages);
        }

        return 'ไม่ระบุ';
    }

    /**
     * Check if doctor is available on a specific day.
     *
     * @param  string  $day
     * @return bool
     */
    public function isAvailableOn($day)
    {
        if (!$this->available_days || !is_array($this->available_days)) {
            return false;
        }

        return in_array($day, $this->available_days);
    }

    /**
     * Get formatted consultation fee.
     *
     * @return string
     */
    public function getFormattedFeeAttribute()
    {
        if ($this->consultation_fee) {
            return '฿' . number_format($this->consultation_fee);
        }

        return 'ปรึกษาเพื่อทราบราคา';
    }

    /**
     * Search doctors by term.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('specialization', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%")
              ->orWhere('education', 'like', "%{$term}%");
        });
    }
}
