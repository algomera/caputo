<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class DrivingPlanning extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    public function instructor(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function vehicle(): BelongsTo {
        return $this->belongsTo(Vehicle::class);
    }

    public function payments(): MorphMany {
        return $this->morphMany(Payment::class, 'paymentable');
    }
}
