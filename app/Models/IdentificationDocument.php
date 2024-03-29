<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdentificationDocument extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    public function identificationType(): BelongsTo {
        return $this->belongsTo(IdentificationType::class);
    }
}
