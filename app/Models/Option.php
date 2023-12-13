<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Option extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function courses() {
        return $this->morphedByMany(Course::class,'costs')->using(Cost::class);
    }

    public function courseVariants() {
        return $this->morphedByMany(CourseVariant::class,'costs')->using(Cost::class);
    }
}
