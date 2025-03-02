<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;

    protected $fillable = ['student_id', 'term', 'kind', 'bus_subscription', 'uniform_subscription', 'discount', 'main_subscription' ,'total_amount', 'paied_amount', 'remaining_amount', 'status'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function installments()
    {
        return $this->hasMany(InvoiceInstallment::class);
    }

}
