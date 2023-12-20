<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class School extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }

    public function teachers() {
        $teacher = $this->users()->whereHas('roles', function ($query) {
            $query->where('name', 'insegnante');
        })->get();

        return $teacher;
    }

    public function instructors() {
        $instructor = $this->users()->whereHas('roles', function ($query) {
            $query->where('name', 'istruttore');
        })->get();

        return $instructor;
    }

    public function secretaries() {
        $secretary = $this->users()->whereHas('roles', function ($query) {
            $query->where('name', 'segretaria');
        })->get();

        return $secretary;
    }

    public function customers(): HasMany {
        return $this->hasMany(Customer::class);
    }

    public function services(): BelongsToMany {
        return $this->belongsToMany(Service::class);
    }

    public function trainings(): HasMany {
        return $this->hasMany(Training::class);
    }

}
