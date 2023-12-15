<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenericMaster extends Model
{
    use HasFactory;
    protected $table = 'generic';

    protected $fillable = [
        'registered_phone',
        'customer_name',
        'customer_address',
        'pincode',
        'external_sr_num',
        'product_category',
        'created_by'
    ]; 
}