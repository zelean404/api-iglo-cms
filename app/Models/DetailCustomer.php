<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCustomer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function title()
    {
        return $this->belongsTo(Title::class, 'id_title');
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class, 'id_occupation');
    }
}
