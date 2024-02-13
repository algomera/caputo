<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Chronology extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $guarded = [];

    public function chronology(): MorphTo {
        return $this->morphTo();
    }

    public function registration(): BelongsTo {
        return $this->BelongsTo(Registration::class);
    }

    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class);
    }
}
