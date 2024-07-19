<?php

namespace App\Http\Controllers\V1\Debt;

use App\Http\Controllers\Controller;
use App\Models\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function index()
    {
        return Debt::all();
    }

    public function show(Debt $debt)
    {
        return $debt;
    }

    public function store(Request $request)
    {
        return Debt::create($request->all());
    }

    public function update(Request $request, Debt $debt)
    {
        $debt->update($request->all());
        return $debt;
    }

    public function destroy(Debt $debt)
    {
        $debt->delete();
        return response()->json(null, 204);
    }

    public function requestContract(Request $request)
    {       
        $userId = $request->user_id;
        $amount = $request->total_amount;
        $term_months = $request->term_months;
        $type = $request->type;

        $debt = Debt::create([
            'user_id' => $userId,
            'type' => $type,
            'total_amount' => $amount,
            'term_months' => $term_months,
        ]);

        return response()->json($debt, 201);
    }

}
