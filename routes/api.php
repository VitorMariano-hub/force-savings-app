<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\User\UserController;
use App\Http\Controllers\V1\Debt\DebtController;
use App\Http\Controllers\V1\Payment\PaymentController;
use App\Http\Controllers\V1\Notification\NotificationController;
use App\Http\Controllers\V1\Contract\ContractController;

// Exemplo de rota protegida com autenticação
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rotas da API V1
Route::prefix('v1')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('debts', DebtController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('notifications', NotificationController::class);

    Route::post('debts/contract-payment', [DebtController::class, 'contractPayment']);
    Route::post('payments/simulate', [PaymentController::class, 'simulatePayment']);
    Route::post('notifications/send-reminder', [NotificationController::class, 'sendPaymentReminder']);
    Route::post('contracts/generator-contract', [ContractController::class, 'generatorContract']);

})->middleware('auth:sanctum');
