<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_OrganizationStructure extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function userManage()
    {
        return $this->belongsTo(UserManage::class, 'id_um');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'id_posisi');
    }
}
