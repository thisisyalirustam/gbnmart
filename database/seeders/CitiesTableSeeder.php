<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City; // Make sure to import the City model

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Country ID for Pakistan
        $countryId = 166;

        // List of states with their respective state_ids and cities
        $states = [
            2726 => [ // Gilgit Baltistan
                'Gilgit', 'Skardu', 'Hunza', 'Gulmit', 'Phander', 'Khaplu', 'Shigar', 'Astore'
            ],
            2729 => [ // Punjab
                'Lahore', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Multan', 'Sialkot', 'Gujranwala', 'Bahawalpur', 'Dera Ghazi Khan', 'Jhelum', 'Gujrat', 'Mianwali', 'Toba Tek Singh', 'Chiniot', 'Narowal'
            ],
            2730 => [ // Sindh
                'Karachi', 'Hyderabad', 'Sukkur', 'Larkana', 'Mirpurkhas', 'Thatta', 'Badin', 'Nawabshah', 'Khairpur', 'Dadu', 'Jacobabad', 'Umerkot', 'Tando Allahyar', 'Tando Muhammad Khan'
            ],
            2728 => [ // Khyber Pakhtunkhwa (KPK)
                'Peshawar', 'Mardan', 'Abbottabad', 'Swat', 'Charsadda', 'Kohat', 'Bannu', 'Dera Ismail Khan', 'Hangu', 'Nowshera', 'Tank', 'Chitral', 'Malakand'
            ],
            2724 => [ // Balochistan
                'Quetta', 'Gwadar', 'Kalat', 'Zhob', 'Killa Saifullah', 'Chaman', 'Loralai', 'Khuzdar', 'Mastung', 'Sibi', 'Jaffarabad', 'Nasirabad', 'Dera Bugti', 'Washuk'
            ],
            2723 => [ // Azad Kashmir
                'Muzaffarabad', 'Mirpur', 'Rawalakot', 'Kotli', 'Bhimber', 'Bagh', 'Poonch', 'Sudhnoti', 'Neelum', 'Hattian Bala'
            ],
            2727 => [ // Islamabad Capital Territory
                'Islamabad'
            ]
        ];

        // Loop through each state and add cities
        foreach ($states as $stateId => $cities) {
            foreach ($cities as $cityName) {
                City::create([
                    'name' => $cityName,
                    'state_id' => $stateId,
                    'country_id' => $countryId,
                    'postal_code' => null, // Optionally, add postal codes if available
                    'latitude' => null, // Optionally, add latitudes if available
                    'longitude' => null, // Optionally, add longitudes if available
                    'status' => true
                ]);
            }
        }
    }
}
