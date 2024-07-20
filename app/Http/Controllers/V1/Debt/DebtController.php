<?php

namespace App\Http\Controllers\V1\Debt;

use App\Http\Controllers\Controller;
use App\Models\Debt as Model;
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

    public function contractPayment(Request $request)
    {
        try {
            $validator = Model::validate($request->all());

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $debt = Model::create([
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
