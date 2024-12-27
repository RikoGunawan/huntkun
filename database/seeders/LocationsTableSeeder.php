<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;
use App\Models\Role;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            // Locations for Explorer
            ['role_id' => Role::where('name', 'Explorer')->first()->id, 'name' => 'Dense Forest', 'image' => 'locations/dense_forest.jpg', 'base_time' => 30, 'reward' => '2x Logs'],
            ['role_id' => Role::where('name', 'Explorer')->first()->id, 'name' => 'Mountain Top', 'image' => 'locations/mountain_top.jpg', 'base_time' => 45, 'reward' => '3x Stones'],

            // Locations for Builder
            ['role_id' => Role::where('name', 'Builder')->first()->id, 'name' => 'Village', 'image' => 'locations/village.jpg', 'base_time' => 40, 'reward' => '4x Bricks'],
            ['role_id' => Role::where('name', 'Builder')->first()->id, 'name' => 'Castle Ruins', 'image' => 'locations/castle_ruins.jpg', 'base_time' => 60, 'reward' => '6x Stones'],

            // Locations for Miner
            ['role_id' => Role::where('name', 'Miner')->first()->id, 'name' => 'Small Cave', 'image' => 'locations/small_cave.jpg', 'base_time' => 25, 'reward' => '2x Coal'],
            ['role_id' => Role::where('name', 'Miner')->first()->id, 'name' => 'Huge Cave', 'image' => 'locations/huge_cave.jpg', 'base_time' => 50, 'reward' => '5x Gold'],

            // Locations for Redstone Engineer
            ['role_id' => Role::where('name', 'Redstone Engineer')->first()->id, 'name' => 'Redstone Mine', 'image' => 'locations/redstone_mine.jpg', 'base_time' => 35, 'reward' => '3x Redstone Dust'],
            ['role_id' => Role::where('name', 'Redstone Engineer')->first()->id, 'name' => 'Abandoned Lab', 'image' => 'locations/abandoned_lab.jpg', 'base_time' => 55, 'reward' => '1x Observer Block'],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
