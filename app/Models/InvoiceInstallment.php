<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceInstallment extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_id', 'amount', 'description'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}
