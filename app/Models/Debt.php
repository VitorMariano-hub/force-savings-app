<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

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
     * Validates the given data using the provided validation rules.
     *
     * @param array $data The data to be validated.
     * @return \Illuminate\Contracts\Validation\Validator The validation object.
     */
    public static function validate($data)
    {
        return Validator::make($data, [
            'user_id' => 'required|exists:users,id',  
            'type' => 'required|string',
            'total_amount' => 'required|numeric',
            'term_months' => 'required|integer|min:1',
        ]);
    }

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
