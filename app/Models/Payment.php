<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'debt_id',
        'amount',
        'payment_date',
        'status',
    ];

    /**
     * Get the debt that owns the payment.
     */
    public function debt()
    {
        return $this->belongsTo(Debt::class);
    }
}
