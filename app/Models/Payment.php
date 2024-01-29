<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

	public function paymentable(): MorphTo {
		return $this->morphTo();
	}

    public function registration(): BelongsTo {
        return $this->belongsTo(Registration::class, 'paymentable_id');
    }

    public function driving(): BelongsTo {
        return $this->belongsTo(DrivingPlanning::class, 'paymentable_id');
    }

    public function document(): MorphOne {
        return $this->MorphOne(Document::class, 'documentable');
    }
}
