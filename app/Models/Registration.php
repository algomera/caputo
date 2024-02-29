<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Registration extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $guarded = [];

    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    public function training(): BelongsTo {
        return $this->belongsTo(Training::class);
    }

    public function medicalPlanning(): HasOne {
        return $this->HasOne(MedicalPlanning::class);
    }

    public function pinkSheet(): HasOne {
        return $this->hasOne(PinkSheet::class);
    }

    public function drivingPlanning(): HasMany {
        return $this->hasMany(DrivingPlanning::class);
    }

    public function payments(): MorphMany {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function documents(): MorphMany {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function chronologies(): MorphMany {
        return $this->MorphMany(Chronology::class, 'chronology');
    }

    public function parentDocuments(): MorphMany {
        return $this->morphMany(Document::class, 'documentable')->where('type', 'documenti di riconoscimento genitore');
    }

    public function companionDocuments(): MorphMany {
        return $this->morphMany(Document::class, 'documentable')->where('type', 'like', '%'.'documenti di riconoscimento accompagnatore'.'%');
    }

    public function parentSignature(): MorphMany {
        return $this->morphMany(Document::class, 'documentable')->where('type', 'firma genitore');
    }

    public function companionsSignatures(): MorphMany {
        return $this->morphMany(Document::class, 'documentable')->where('type', 'like', '%'.'firma accompagnatore'.'%');
    }

    public function course() {
        return $this->BelongsToThrough(Course::class, Training::class);
    }

    public function school() {
        return $this->BelongsToThrough(School::class, Training::class);
    }

    public function getPerformedGuidesAttribute() {
        return $this->drivingPlanning()->where('performed', 'svolta')->get();
    }

    public function getFinalPriceAttribute() {
        if ($this->discount) {
            return $this->price - $this->discount;
        }
        return $this->price;
    }

    public function getTotalPaymentAttribute() {
        $total = 0;
        $payments = $this->payments()->get();

        foreach ($payments as $payment) {
            $total += $payment->amount;
        }
        return $total;
    }

    public function getRemainToPayAttribute() {
        if (($this->finalPrice - $this->totalPayment) < 0) {
            return 0;
        }
        return ($this->finalPrice - $this->totalPayment);
    }

    public function getSumPaymentsAttribute() {
        $payments = $this->payments()->get();
        $sum = 0;

        foreach ($payments as $payment) {
            $sum += $payment->amount;
        }

        return $sum;
    }
}
