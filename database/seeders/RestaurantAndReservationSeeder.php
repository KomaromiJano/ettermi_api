<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Reservation;
use Carbon\Carbon;

class RestaurantAndReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ellenőrizzük, hogy van-e már étterem az adatbázisban
        if (Restaurant::count() > 0) {
            return;
        }

        // Éttermek létrehozása
        $restaurants = [
            ['name' => 'Gourmet Bistro', 'location' => 'Budapest, Fő tér 10.', 'capacity' => 50],
            ['name' => 'Pizza Express', 'location' => 'Debrecen, Kossuth tér 5.', 'capacity' => 30],
            ['name' => 'Steak House', 'location' => 'Szeged, Dóm tér 8.', 'capacity' => 40],
        ];

        foreach ($restaurants as $restaurant) {
            Restaurant::create($restaurant);
        }

        // Foglalások létrehozása
        $gourmet = Restaurant::where('name', 'Gourmet Bistro')->first();
        $pizza = Restaurant::where('name', 'Pizza Express')->first();

        $reservations = [
            [
                'restaurant_id' => $gourmet->id,
                'customer_name' => 'Kiss Péter',
                'customer_email' => 'peter.kiss@example.com',
                'reservation_date' => Carbon::now()->addDays(3),
                'guest_count' => 2
            ],
            [
                'restaurant_id' => $pizza->id,
                'customer_name' => 'Nagy Anna',
                'customer_email' => 'anna.nagy@example.com',
                'reservation_date' => Carbon::now()->addDays(5),
                'guest_count' => 4
            ],
        ];

        foreach ($reservations as $reservation) {
            Reservation::create($reservation);
        }
    }
}
