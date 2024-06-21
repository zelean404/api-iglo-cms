<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    protected $guarded = ['id'];

    public function userManage()
    {
        return $this->belongsTo(UserManage::class, 'id_um');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'id_tipe');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company');
    }
}
