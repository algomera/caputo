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

    public function lessons(): HasMany {
        return $this->hasMany(Lesson::class);
    }

    public function options(): BelongsToMany {
        return $this->belongsToMany(Option::class, 'costs')->using(Cost::class);
    }

    public function getOptions(): MorphToMany {
        return $this->morphToMany(Option::class, 'costs');
    }
}
