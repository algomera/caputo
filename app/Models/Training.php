<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Training extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function school(): BelongsTo {
        return $this->belongsTo(School::class);
    }

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

    public function courseVariant(): BelongsTo {
        return $this->belongsTo(CourseVariant::class, 'variant_id');
    }

    public function customers(): BelongsToMany {
        return $this->belongsToMany(Customer::class);
    }

    public function plannings(): HasMany {
        return $this->hasMany(LessonPlanning::class);
    }
}
