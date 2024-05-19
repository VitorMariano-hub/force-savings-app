<?php

namespace App\Http\Controllers\V1\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

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
}
