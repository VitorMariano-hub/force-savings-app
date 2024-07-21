<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Contract extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'down_payment',
        'contract_amount',
        'financed_amount',
        'monthly_payment',
        'term_months',
        'type',
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
            'down_payment' => 'required|numeric|min:0',
            'contract_amount' => 'required|numeric|min:0',
            'financed_amount' => 'required|numeric|min:0',
            'monthly_payment' => 'required|numeric|min:0',
            'term_months' => 'required|integer|min:1',
            'type' => 'required|string'
        ]);
    }
}
