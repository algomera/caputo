<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IdentificationType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function identificationDocuments(): HasMany {
        return $this->hasMany(IdentificationDocument::class);
    }
}
