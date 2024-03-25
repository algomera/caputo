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

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function registrations(): HasMany {
        return $this->hasMany(Registration::class);
    }

    public function plannings(): HasMany {
        return $this->hasMany(LessonPlanning::class);
    }

    public function customers(): BelongsToMany {
        return $this->BelongsToMany(Customer::class, 'registrations');
    }

    public function customerMissingData($customer) {
        return $this->registrations()->where('customer_id', $customer)->first()->step_skipped;
    }

    public function customerPresence($customer) {
        $presences = 0;
        foreach ($this->plannings()->whereNotNull('begin')->get() as $lessonPlanning) {
            $lessonPresence = $lessonPlanning->presences()->where('customer_id', $customer)->first();
            if ($lessonPresence) {
                if ($lessonPresence->followed == 1) {
                    $presences += 1;
                }
            }
        }
        return $presences;
    }
}
