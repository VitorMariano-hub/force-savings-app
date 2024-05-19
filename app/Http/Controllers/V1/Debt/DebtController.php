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
}
