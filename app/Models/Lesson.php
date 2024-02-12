<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lesson extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

    public function courseVariant(): BelongsTo {
        return $this->belongsTo(CourseVariant::class, 'variant_id');
    }

    public function planning(): HasOne {
        return $this->HasOne(LessonPlanning::class);
    }
}
