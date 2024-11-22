<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoices;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $guarded = ['id'];
    // public function invoice()
    // {
    //    return $this->hasMany(Invoices::class);
    // }
}
