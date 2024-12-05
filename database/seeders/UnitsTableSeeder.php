<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Add weight units
        $weightUnits = [
            ['name' => 'Kilogram', 'symbol' => 'kg', 'type' => 'weight', 'description' => 'The base unit of mass in the International System of Units (SI).'],
            ['name' => 'Gram', 'symbol' => 'g', 'type' => 'weight', 'description' => 'A metric unit of mass, equal to one thousandth of a kilogram.'],
            ['name' => 'Pound', 'symbol' => 'lb', 'type' => 'weight', 'description' => 'A unit of weight commonly used in the United States and the British Imperial system.'],
            ['name' => 'Ounce', 'symbol' => 'oz', 'type' => 'weight', 'description' => 'A smaller unit of weight used in the US and UK, equal to one-sixteenth of a pound.'],
        ];

        // Add length units
        $lengthUnits = [
            ['name' => 'Meter', 'symbol' => 'm', 'type' => 'length', 'description' => 'The base unit of length in the SI system.'],
            ['name' => 'Centimeter', 'symbol' => 'cm', 'type' => 'length', 'description' => 'A metric unit of length, equal to one hundredth of a meter.'],
            ['name' => 'Millimeter', 'symbol' => 'mm', 'type' => 'length', 'description' => 'A metric unit of length, equal to one thousandth of a meter.'],
            ['name' => 'Kilometer', 'symbol' => 'km', 'type' => 'length', 'description' => 'A metric unit of length, equal to 1,000 meters.'],
            ['name' => 'Inch', 'symbol' => 'in', 'type' => 'length', 'description' => 'A unit of length in the imperial system, equal to 1/12 of a foot.'],
            ['name' => 'Foot', 'symbol' => 'ft', 'type' => 'length', 'description' => 'A unit of length in the imperial system, equal to 12 inches.'],
            ['name' => 'Mile', 'symbol' => 'mi', 'type' => 'length', 'description' => 'A unit of length used in the imperial system, equal to 5,280 feet.'],
        ];

        // Add volume units
        $volumeUnits = [
            ['name' => 'Liter', 'symbol' => 'L', 'type' => 'volume', 'description' => 'The base unit of volume in the SI system.'],
            ['name' => 'Milliliter', 'symbol' => 'mL', 'type' => 'volume', 'description' => 'A metric unit of volume, equal to one thousandth of a liter.'],
            ['name' => 'Cubic Meter', 'symbol' => 'm³', 'type' => 'volume', 'description' => 'A unit of volume in the SI system, equal to one thousand liters.'],
            ['name' => 'Gallon', 'symbol' => 'gal', 'type' => 'volume', 'description' => 'A unit of volume in the imperial system, equal to 4.546 liters.'],
            ['name' => 'Quart', 'symbol' => 'qt', 'type' => 'volume', 'description' => 'A unit of volume in the imperial system, equal to one quarter of a gallon.'],
        ];

        // Add time units


        // Insert weight units
        foreach ($weightUnits as $unit) {
            Unit::create($unit);
        }

        // Insert length units
        foreach ($lengthUnits as $unit) {
            Unit::create($unit);
        }

        // Insert volume units
        foreach ($volumeUnits as $unit) {
            Unit::create($unit);
        }

        // Insert time units

    }
}
