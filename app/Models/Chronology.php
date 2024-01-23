<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Chronology extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $guarded = [];

    public function customer() {
        return $this->BelongsToThrough(Customer::class, Registration::class);
    }

    public function registration(): BelongsTo {
        return $this->belongsTo(Registration::class);
    }

    public function document(): MorphOne {
        return $this->morphOne(Document::class, 'documentable');
    }
}
