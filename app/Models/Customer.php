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

    public function chronologies(): HasMany {
        return $this->hasMany(Chronology::class);
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

    public function customerDocuments(): MorphMany {
        return $this->morphMany(Document::class, 'documentable')->where('type', 'documenti di riconoscimento');
    }

    public function parentDocuments(): MorphMany {
        return $this->morphMany(Document::class, 'documentable')->where('type', 'documenti di riconoscimento genitore');
    }

    public function companionDocuments(): MorphMany {
        return $this->morphMany(Document::class, 'documentable')->where('type', 'like', '%'.'documenti di riconoscimento accompagnatore'.'%');
    }

    public function customerSignature(): MorphMany {
        return $this->morphMany(Document::class, 'documentable')->where('type', 'firma');
    }

    public function parentSignature(): MorphMany {
        return $this->morphMany(Document::class, 'documentable')->where('type', 'firma genitore');
    }

    public function companionsSignatures(): MorphMany {
        return $this->morphMany(Document::class, 'documentable')->where('type', 'like', '%'.'firma accompagnatore'.'%');
    }
}
