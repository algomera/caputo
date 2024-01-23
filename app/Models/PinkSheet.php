<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PinkSheet extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $guarded = [];

    public function registration(): BelongsTo {
        return $this->belongsTo(Registration::class);
    }

    public function customer() {
        return $this->BelongsToThrough(Customer::class, Registration::class);
    }
}
