<?php

use App\Http\Controllers\ParkingLotController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/', [ParkingLotController::class, 'index']);
Route::post('/{id}', [ParkingLotController::class, 'order']);
Route::get('/transaction/{id}', [ParkingLotController::class, 'checkPayment']);

//transaction
Route::post('/transaction/{id}', [TransactionController::class, 'payment']);
