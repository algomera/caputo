<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class registration extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    public function training(): BelongsTo {
        return $this->belongsTo(Training::class);
    }

    public function payments(): MorphMany {
        return $this->morphMany(Payment::class, 'paymentable');
    }
}
