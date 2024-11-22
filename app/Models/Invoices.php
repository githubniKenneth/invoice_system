<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Invoices extends Model
{
    use HasFactory;
    protected $table = 'invoices';

    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
 
}
