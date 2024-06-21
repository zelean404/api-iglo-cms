<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class UserManage extends Model
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $guarded = ['id'];

    //login-logout
    // public function getJWTIdentifier()
    // {
    //     return $this->getKey();
    // }

    // /**
    //  * Return a key value array, containing any custom claims to be added to the JWT.
    //  *
    //  * @return array
    //  */
    // public function getJWTCustomClaims()
    // {
    //     return [];
    // }


    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function detailOrganizationStructures()
    {
        return $this->hasMany(Detail_OrganizationStructure::class, 'id_um');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'id_tipe', 'id');
    }
    
}
