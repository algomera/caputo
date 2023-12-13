<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function school(): BelongsTo {
        return $this->belongsTo(School::class);
    }

    public function identificationDocument(): HasOne {
        return $this->hasOne(IdentificationDocument::class);
    }
}
