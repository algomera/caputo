<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
        return $this->belongsToMany(Service::class, 'school_service');
    }

    public function otherServices() {
        $servicesNotAssociated = Service::whereDoesntHave('schools', function($query) {
            $query->whereIn('school_id', [$this->id]);
        })->get();

        return $servicesNotAssociated;
    }

    public function registrations(): HasManyThrough {
        return $this->hasManyThrough(Registration::class, Training::class);
    }

    public function medicalVisits(): HasManyThrough {
        return $this->hasManyThrough(Registration::class, Training::class)->whereJsonContains('optionals', '15')->with('customer', 'course', 'medicalPlanning');
    }

    public function trainings(): HasMany {
        return $this->hasMany(Training::class);
    }

}
