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
        return $this->belongsTo(Customer::class, 'documentable_id');
    }

    public function payment(): BelongsTo {
        return $this->belongsTo(Payment::class, 'documentable_id');
    }

    public function registration(): BelongsTo {
        return $this->belongsTo(Registration::class, 'documentable_id');
    }
}
