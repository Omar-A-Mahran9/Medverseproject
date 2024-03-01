<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $appends = ['profile'];
    protected $fillable = [
        'name',
        'phone',
        'username',
        'email',
        'city',
        'position',
        'image',
        'role',
        'clinicname',
        'universityname',
        'companyname',
        'Address',
        'Location',
        'type',
        'Package_id',
        'password',
    ];
    public function getProfileAttribute()
    {
        return $this->image ? $this->getImageFullPath($this->image) : null;
    }
    protected function getImageFullPath($imageName)
    {
      

        // Concatenate the base URL and the image filename
        return asset('Storage/'.$imageName);
    }
    protected $attributes = [
        'role' => 'CLIENT', 
    ];

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

    // public function image():Attribute{
    //     return Attribute::make(
    //         get: fn ($value)=>asset(Storage::url($value) ?? "noimage.png")
    //     );
    //     }

        function mainclinic(){
            return $this->hasOne(Mainclinics::class,'user_id');
        }
}
