<?php

namespace App\Http\Controllers\V1\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract as Model;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Validates contract data and generates contract details.
     *
     * @param Request $request The request containing contract data.
     * @throws \Illuminate\Validation\ValidationException If validation fails.
     * @return \Illuminate\Http\JsonResponse The generated contract details in JSON format.
     */
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

    /**
     * Create a new contract for a user.
     *
     * @param Request $request The HTTP request containing the contract data.
     * @param int $user_id The ID of the user for whom the contract is being created.
     * @return \Illuminate\Http\JsonResponse The created contract in JSON format, with a status code of 201 if successful.
     * @throws \Throwable If an error occurs during the creation of the contract.
     */
    public function createContract(Request $request, $user_id)
    {
        try {
            $validator = Model::validate($request->all());

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $contract = Model::create([
                'user_id' => $user_id,
                'down_payment' => $request->down_payment,
                'contract_amount' => $request->contract_amount,
                'financed_amount' => $request->financed_amount,
                'monthly_payment' => $request->monthly_payment,
                'term_months' => $request->term_months,
                'type' => $request->type
            ]);

            return response()->json($contract, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
