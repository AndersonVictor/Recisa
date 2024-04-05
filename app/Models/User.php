<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //Son las columnas que se van a modificar 
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'user_level',
        'image'
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
    public function groups(){
        return $this->belongsTo(UserGroup::class);
    }
     //Guardar nuestas images 
    public function hanbleUploadImage($image){
         $file = $image;
         $name = time() . $file->getClientOriginalName();
         //$file->move(public_path() . '/img/productos/', $name);
         Storage::putFileAs('/public/perfiles/',$file,$name,'public');         
         return $name;
    }
    
}
