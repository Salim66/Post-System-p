<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment', 'id', 'invoice_id');
    }

    public function invoice_detail()
    {
        return $this->hasMany('App\Models\InvoiceDetail', 'invoice_id', 'id');
    }
}
