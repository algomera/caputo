<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseRegistrationStep extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function registrationType(): BelongsTo {
        return $this->BelongsTo(RegistrationType::class);
    }
}
