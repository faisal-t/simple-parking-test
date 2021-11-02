<?php

namespace Database\Seeders;

use App\Models\ParkingLot;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ParkingLot::create(
            [
                'name' => "Parking Lot 1",
                'status' => "available for booking"
            ]
        );

        ParkingLot::create(
            [
                'name' => "Parking Lot 2",
                'status' => "available for booking"
            ]
        );

        ParkingLot::create(
            [
                'name' => "Parking Lot 3",
                'status' => "available for booking"
            ]
        );
    }
}
