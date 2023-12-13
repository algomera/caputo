<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Cost extends MorphPivot
{
    protected $table = 'costs';
    protected $guarded = [];

}
