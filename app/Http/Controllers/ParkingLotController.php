<?php

namespace App\Http\Controllers;

use App\Models\ParkingLot;
use App\Models\Transaction;
use Carbon\Carbon;


class ParkingLotController extends Controller
{
    //check Avaliable Parking Lot
    public function index()
    {
        $data = ParkingLot::where('status', 'available for booking')->get();

        //check parking lot available
        if ($data->count() == 0) {
            return response([
                'status' => 'success',
                'message' => 'fully booked',
            ]);
        }

        return response([
            'status' => 'success',
            'message' => 'success',
            'data' => $data,
        ]);
    }

    public function order(ParkingLot $id)
    {
        if ($id->status == "booked") {
            $data = ParkingLot::where('status', 'available for booking')->get();

            //check parking lot available
            if ($data->count() == 0) {
                return response([
                    'status' => 'success',
                    'message' => 'fully booked',
                ]);
            }

            return response([
                'status' => 'success',
                'message' => 'The parking space you ordered has been booked, please select the available parking space',
                'data' => $data,
            ]);
        }

        //after check update status parking lot
        $id->update(['status' => "booked"]);



        //make order for transaction
        $order = new Transaction;
        $order->parking_lots_id = $id->id;
        $order->price = 0;
        $order->status = "current transaction";
        $order->save();

        return response([
            'status' => 'ok',
            'message' => 'success order',
        ]);
    }

    public function checkPayment(Transaction $id)
    {
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
        return response([
            'status' => 'ok',
            'message' => 'success',
            'data' => $pay,
        ]);
    }
}
