<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function documentable(): MorphTo {
		return $this->morphTo();
	}

    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    public function chronology(): BelongsTo {
        return $this->belongsTo(Chronology::class);
    }
}
