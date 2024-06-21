<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function industriType()
    {
        return $this->belongsTo(IndustriType::class, 'id_industri_type');
    }

    public function companyScale()
    {
        return $this->belongsTo(CompanyScale::class, 'id_company_scale');
    }

    public function detailCustomers()
    {
        return $this->hasMany(DetailCustomer::class, 'id_customer');
    }
}
