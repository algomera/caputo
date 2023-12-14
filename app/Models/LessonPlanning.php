<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LessonPlanning extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function training(): BelongsTo {
        return $this->belongsTo(Training::class);
    }

    public function lesson(): BelongsTo {
        return $this->belongsTo(Lesson::class);
    }

    public function presences(): HasMany {
        return $this->hasMany(Presence::class);
    }
}
