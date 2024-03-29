<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BranchCourse extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function registrationStep(): BelongsTo {
        return $this->belongsTo(CourseRegistrationStep::class);
    }

    public function branch(): BelongsTo {
        return $this->belongsTo(Branch::class);
    }
}
