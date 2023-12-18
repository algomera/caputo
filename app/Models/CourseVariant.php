<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class CourseVariant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

    public function prices(): HasMany {
        return $this->hasMany(CoursePrice::class);
    }

    public function lessons(): HasMany {
        return $this->hasMany(Lesson::class, 'variant_id');
    }

    public function options(): BelongsToMany {
        return $this->belongsToMany(Option::class, 'costs')->using(Cost::class);
    }

    public function getOptions(): MorphToMany {
        return $this->morphToMany(Option::class, 'costs');
    }

    public function trainings(): HasMany {
        return $this->hasMany(Training::class, 'variant_id');
    }

    public function interested(): HasMany {
        return $this->hasMany(InterestedCourses::class);
    }

    public function getDurationAttribute() {
        $lessons = $this->lessons()->get();
        $duration = 0;

        foreach ($lessons as $lesson) {
            $duration += $lesson->duration;
        }
        return (floor($duration / 60).':'. ($duration % 60));
    }
}
