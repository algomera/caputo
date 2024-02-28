<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class DrivingPlanning extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $guarded = [];

    public function school() {
        return $this->BelongsToThrough(School::class, [Training::class, Registration::class]);
    }

    public function customer() {
        return $this->BelongsToThrough(Customer::class, Registration::class);
    }

    public function registration(): BelongsTo {
        return $this->belongsTo(Registration::class);
    }

    public function instructor(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vehicle(): BelongsTo {
        return $this->belongsTo(Vehicle::class);
    }

    public function payments(): MorphMany {
        return $this->morphMany(Payment::class, 'paymentable');
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
