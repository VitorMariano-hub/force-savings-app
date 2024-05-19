<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'total_amount',
        'term_months',
    ];

    /**
     * Get the user that owns the debt.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the payments for the debt.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
