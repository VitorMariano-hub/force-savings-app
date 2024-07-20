<?php

namespace App\Http\Controllers\V1\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Debt;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::all();
    }

    public function show(Payment $payment)
    {
        return $payment;
    }

    public function store(Request $request)
    {
        return Payment::create($request->all());
    }

    public function update(Request $request, Payment $payment)
    {
        $payment->update($request->all());
        return $payment;
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(null, 204);
    }

    public function simulatePayment(Request $request)
    {
        try {
            $validator = Debt::validate($request->all());

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $debt = Debt::create([
                'user_id' => $request->user_id,
                'type' => $request->type,
                'total_amount' => $request->total_amount,
                'term_months' => $request->term_months,
            ]);

            return response()->json($debt, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
