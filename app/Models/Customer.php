<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function school(): BelongsTo {
        return $this->belongsTo(School::class);
    }

    public function identificationDocuments(): HasMany {
        return $this->hasMany(IdentificationDocument::class);
    }

    public function registrations(): HasMany {
        return $this->hasMany(Registration::class);
    }

    public function presences(): HasMany {
        return $this->hasMany(Presence::class);
    }

    public function medicals(): HasMany {
        return $this->hasMany(MedicalPlanning::class);
    }

    public function interested(): HasMany {
        return $this->hasMany(InterestedCourses::class);
    }

    public function documents(): MorphMany {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function chronologies(): MorphMany {
        return $this->MorphMany(Chronology::class, 'chronology');
    }

    public function customerDocuments(): MorphMany {
        return $this->morphMany(Document::class, 'documentable')->where('type', 'documenti di riconoscimento');
    }

    public function customerSignature(): MorphMany {
        return $this->morphMany(Document::class, 'documentable')->where('type', 'firma');
    }

    public function photo() {
        return $this->documents()->where('type', 'fototessera');
    }

    public function patent() {
        return $this->identificationDocuments()->where('identification_type_id', 2)->first();
    }

    public function otherIdentificationDocuments() {
        $typeDocuments = IdentificationType::where('name', '!=', 'patente')->whereDoesntHave('identificationDocuments', function($query) {
            $query->whereIn('customer_id', [$this->id]);
        })->get();

        return $typeDocuments;
    }

    public function getFullNameAttribute() {
        return $this->name . ' ' . $this->lastName;
    }
}
