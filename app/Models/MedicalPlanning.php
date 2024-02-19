<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MedicalPlanning extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $guarded = [];

    public function registration(): BelongsTo {
        return $this->belongsTo(Registration::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function payments(): MorphOne {
        return $this->morphOne(Payment::class, 'paymentable');
    }

    public function customer() {
        return $this->BelongsToThrough(Customer::class, Registration::class);
    }

    public function training() {
        return $this->BelongsToThrough(Training::class, Registration::class);
    }

    public function school() {
        return $this->BelongsToThrough(School::class, [Training::class, Registration::class]);
    }

    public function course() {
        return $this->BelongsToThrough(Course::class, [Training::class, Registration::class]);
    }
}
