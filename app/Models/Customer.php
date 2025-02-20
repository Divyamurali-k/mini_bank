<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasFactory,HasApiTokens;

    protected $table = 'customers';

    protected $primaryKey = 'customer_id'; // Set the primary key

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'amount',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'customer_id', 'customer_id');
    }
}
