<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BranchCourse extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function branch_courseable(): MorphTo {
		return $this->morphTo();
	}

    public function branch(): BelongsTo {
        return $this->belongsTo(Branch::class);
    }
}
