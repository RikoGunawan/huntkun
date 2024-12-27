<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Explorer', 'description' => 'Kasur dan crafting table sudah cukup', 'image' => 'roles/explorer.jpg'],
            ['name' => 'Builder', 'description' => 'Membangun adalah hobiku!', 'image' => 'roles/builder.jpg'],
            ['name' => 'Miner', 'description' => 'Bangun tidur kuterus mining...', 'image' => 'roles/miner.jpg'],
            ['name' => 'Redstone Engineer', 'description' => 'Sepuh minecraft yang suka buat hal-hal keren!', 'image' => 'roles/redstone_engineer.jpg'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
