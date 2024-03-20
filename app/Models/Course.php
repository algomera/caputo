<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function service(): BelongsTo {
        return $this->belongsTo(Service::class);
    }

    public function options(): BelongsToMany {
        return $this->belongsToMany(Option::class, 'costs')->using(Cost::class);
    }

    public function prices(): HasMany {
        return $this->hasMany(CoursePrice::class);
    }

    public function variants(): HasMany {
        return $this->hasMany(CourseVariant::class);
    }

    public function lessons(): HasMany {
        return $this->hasMany(Lesson::class);
    }

    public function trainings(): HasMany {
        return $this->hasMany(Training::class);
    }

    public function interested(): HasMany {
        return $this->hasMany(InterestedCourses::class);
    }

    public function courseRegistrationSteps(): HasMany {
        return $this->hasMany(CourseRegistrationStep::class);
    }

    public function getOptions(): MorphToMany {
        return $this->morphToMany(Option::class, 'costs');
    }

    public function getDurationAttribute() {
        $lessons = $this->lessons()->get();
        $duration = 0;

        foreach ($lessons as $lesson) {
            $duration += $lesson->duration;
        }
        return (floor($duration / 60).':'. ($duration % 60));
    }

    public function getStepCourse($registrationTypeId) {
        return CourseRegistrationStep::where('course_id', $this->id)->where('registration_type_id', $registrationTypeId)->first();
    }
}
