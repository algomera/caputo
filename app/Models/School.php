<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }

    public function customers(): HasMany {
        return $this->hasMany(Customer::class);
    }

    public function services(): BelongsToMany {
        return $this->belongsToMany(Service::class);
    }

}
