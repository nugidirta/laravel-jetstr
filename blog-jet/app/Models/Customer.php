<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code_cust', 'name_cust', 'address_cust', 'city_cust', 'province_cust', 'postal_code', 'country_cust', 'phone_cust', 'email_cust'
    ];
}
