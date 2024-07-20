<?php

namespace App\Http\Controllers\V1\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract as Model;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function generatorContract(Request $request) 
    {
        try {
            $validatedData = $request->validate([
                'value' => 'required|numeric|min:0', 
                'total_amount' => 'required|numeric|min:0',
                'income' => 'required|numeric|min:0',
                'term_months' => 'required|integer|min:1', 
                'type' => 'required|string'
            ]);

            $down_payment = $validatedData['value'];
            $contract_amount = $validatedData['total_amount'];
            $income = $validatedData['income'];
            $term_months = $validatedData['term_months'];

            $financed_amount = $contract_amount - $down_payment;

            $monthly_payment = $financed_amount / $term_months;

            $max_affordable_payment = $income * 0.30;

            if ($monthly_payment > $max_affordable_payment) {
                return response()->json(['error' => 'A parcela excede 30% da renda mensal.'], 422);
            }

            return response()->json([
                'down_payment' => $down_payment,
                'contract_amount' => $contract_amount,
                'financed_amount' => $financed_amount,
                'monthly_payment' => $monthly_payment,
                'term_months' => $term_months,
                'type' => $validatedData['type']
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
