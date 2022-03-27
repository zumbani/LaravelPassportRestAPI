<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FitmentQuotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference', 
        'vin',
        'make',
        'manufacturer',
        'year',
        'registration',
        'issue_date',
        'expires_date',
        'fitment_cost',
        'fitment_centre_id',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'accepted',
    ]; 
}
