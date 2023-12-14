<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presence extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer():BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    public function planning(): BelongsTo {
        return $this->belongsTo(LessonPlanning::class, 'lesson_planning_id');
    }
}
