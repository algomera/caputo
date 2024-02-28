<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Models\User;

class School extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $guarded = [];

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }

    public function services(): BelongsToMany {
        return $this->belongsToMany(Service::class, 'school_service');
    }

    public function customers(): HasMany {
        return $this->hasMany(Customer::class);
    }

    public function trainings(): HasMany {
        return $this->hasMany(Training::class);
    }

    public function registrations(): HasManyThrough {
        return $this->hasManyThrough(Registration::class, Training::class);
    }

    public function medicalVisits(): HasManyThrough {
        return $this->hasManyThrough(Registration::class, Training::class)->whereJsonContains('optionals', 15)->with('customer', 'course', 'medicalPlanning');
    }

    public function drivingPlannings() {
        return $this->hasManyDeep(DrivingPlanning::class, [Training::class, Registration::class]);
    }

    public function secretaries() {
        $secretary = $this->users()->whereHas('roles', function ($query) {
            $query->where('name', 'segretaria');
        })->get();

        return $secretary;
    }

    public function otherServices() {
        $servicesNotAssociated = Service::whereDoesntHave('schools', function($query) {
            $query->whereIn('school_id', [$this->id]);
        })->get();

        return $servicesNotAssociated;
    }
}
