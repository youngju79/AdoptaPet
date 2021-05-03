<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasListedPets()
    {
        return $this->hasMany(Pet::class)->count() > 0;
    }
    public function listedPets()
    {
        return $this->hasMany(Pet::class)->with(['gender', 'age']);
    }
    public function hasFavoritedPets()
    {
        return $this->hasMany(Favorite::class)->count() > 0;
    }
    public function favoritedPets()
    {
        return $this->hasMany(Favorite::class)->with(['pet.gender', 'pet.age']);;
    }
    public function hasFavorite($id)
    {
        return $this->hasMany(Favorite::class)->where('pet_id', '=', $id)->count() > 0;
    }
    public function getFavoriteId($id)
    {
        return $this->hasMany(Favorite::class)->where('pet_id', '=', $id)->first()->id;
    }
}
