<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $guarded = ['id'];

    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoices', 'invoice_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
