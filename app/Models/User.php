<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function schools(): BelongsToMany {
       return $this->belongsToMany(School::class);
    }

    public function getRoleAttribute() {
        return $this->roles[0];
    }

    public function getRedirectRouteName() {
        return match ($this->role->name) {
            'admin' => 'service',
            'responsabile sede' => 'service',
            'medico' => 'service',
            'insegnante' => 'service',
            'istruttore' => 'service',
            'segretaria' => 'service',
        };
    }

    public function medicals(): HasMany {
        return $this->hasMany(MedicalPlanning::class);
    }

    public function isAdmin() {
        return 'admin' === $this->role->name;
    }
}
