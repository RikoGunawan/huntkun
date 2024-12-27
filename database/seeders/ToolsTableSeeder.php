<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Role;

class ToolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tools = [
            // Tools for Explorer
            ['role_id' => Role::where('name', 'Explorer')->first()->id, 'name' => 'Wooden Pickaxe', 'icon' => 'tools/wooden_pickaxe.png', 'modifier' => 1.0],
            ['role_id' => Role::where('name', 'Explorer')->first()->id, 'name' => 'Iron Sword', 'icon' => 'tools/iron_sword.png', 'modifier' => 1.2],

            // Tools for Builder
            ['role_id' => Role::where('name', 'Builder')->first()->id, 'name' => 'Wooden Plank', 'icon' => 'tools/wooden_plank.png', 'modifier' => 1.1],
            ['role_id' => Role::where('name', 'Builder')->first()->id, 'name' => 'Stone Brick', 'icon' => 'tools/stone_brick.png', 'modifier' => 1.3],

            // Tools for Miner
            ['role_id' => Role::where('name', 'Miner')->first()->id, 'name' => 'Stone Pickaxe', 'icon' => 'tools/stone_pickaxe.png', 'modifier' => 1.5],
            ['role_id' => Role::where('name', 'Miner')->first()->id, 'name' => 'Diamond Pickaxe', 'icon' => 'tools/diamond_pickaxe.png', 'modifier' => 2.0],

            // Tools for Redstone Engineer
            ['role_id' => Role::where('name', 'Redstone Engineer')->first()->id, 'name' => 'Redstone Torch', 'icon' => 'tools/redstone_torch.png', 'modifier' => 1.4],
            ['role_id' => Role::where('name', 'Redstone Engineer')->first()->id, 'name' => 'Observer Block', 'icon' => 'tools/observer_block.png', 'modifier' => 1.8],
        ];

        foreach ($tools as $tool) {
            Tool::create($tool);
        }
    }
}
