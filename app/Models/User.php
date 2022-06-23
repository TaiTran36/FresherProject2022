<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use App\Notifications\PasswordReset;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes; // add soft delete
use Tymon\JWTAuth\Contracts\JWTSubject;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable implements JWTSubject
{
    protected $table = 'users';

    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes; // add soft delete
    // use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username_login',
        'email',
        'password',
        'name', 'date_of_birth', 'nickname', 'description', 'avatar', 'address', 'phone_number',
        'profile_photo_path', 'provider_id', 'provider',
        'access_token', "last_seen"
    ];
    // public $sortable = [
    //     'username_login',
    //     'email',
    //     'password',
    //     'name', 'date_of_birth', 'nickname', 'description', 'avatar', 'address', 'phone_number',
    //     'profile_photo_path', 'provider_id', 'provider',
    //     'access_token', "last_seen"
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    protected $dates = ['deleted_at'];

    /**
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function mySelf()
    {
        $user = Auth::user();
        if ($user) {
            return User::find($user->id);
        }
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
