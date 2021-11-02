<?php

namespace App\Http\Controllers;

use App\Models\ParkingLot;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function payment(Request $request, Transaction $id)
    {
        if ($id->status == "paid") {
            return response([
                'status' => 'success',
                'message' => 'your transaction has been paid'
            ]);
        }

        $timeNow = (int)Carbon::now()->format('H');
        $timeOrder = (int)$id->created_at->format('H');
        $totalTime = $timeNow - $timeOrder;
        $pay = 0;
        if ($totalTime >= 1 && $totalTime < 2) {
            $pay = 20;
        } else if ($totalTime >= 2 && $totalTime < 3) {
            $pay = 60;
        } else if ($totalTime >= 3 && $totalTime < 4) {
            $pay = 240;
        } else if ($totalTime >= 4) {
            $pay = 300;
        }

        $dataPayment = 0;
        $dataPayment = $request->payment;

        if ($dataPayment - $pay != 0) {
            return response([
                'status' => 'failed',
                'message' => 'your payment is less'
            ]);
        }

        $id->update(['status' => 'paid', 'price' => $dataPayment]);

        $parking_lot = ParkingLot::find($id->parking_lots_id);
        $parking_lot->update(['status' => 'available for booking']);

        return response([
            'status' => 'ok',
            'message' => 'success',
            'data' => "SuccessFul Payment",
        ]);
    }
}
