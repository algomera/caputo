<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Registration extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;


    protected $guarded = [];

    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    public function training(): BelongsTo {
        return $this->belongsTo(Training::class);
    }

    public function medicalPlanning(): HasOne {
        return $this->HasOne(MedicalPlanning::class);
    }

    public function pinkSheet(): HasOne {
        return $this->hasOne(PinkSheet::class);
    }

    public function chronologies(): HasMany {
        return $this->hasMany(Chronology::class);
    }

    public function drivingPlanning(): HasMany {
        return $this->hasMany(DrivingPlanning::class);
    }

    public function payments(): MorphMany {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function documents(): MorphMany {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function course() {
        return $this->BelongsToThrough(Course::class, Training::class);
    }

    public function school() {
        return $this->BelongsToThrough(School::class, Training::class);
    }
}
