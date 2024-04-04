<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseRegistrationStep extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'steps_id' => 'array',
    ];


    public function registrationType(): BelongsTo {
        return $this->BelongsTo(RegistrationType::class);
    }

    public function getSteps() {
        return Step::whereIn('id', json_decode($this->steps_id));
    }

    public function course(): BelongsTo {
        return $this->BelongsTo(Course::class);
    }

    public function courseVariant(): BelongsTo {
        return $this->BelongsTo(CourseVariant::class, 'variant_id');
    }

    public function branchCourses(): HasMany {
        return $this->HasMany(BranchCourse::class);
    }

}
