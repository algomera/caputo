<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Step extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function course() {
        return CourseRegistrationStep::whereJsonContains('steps_id', $this->id)->get();
    }
}
