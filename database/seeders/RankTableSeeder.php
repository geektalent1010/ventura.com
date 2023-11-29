<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ranks')->insert([
            [
                'name' => 'Level 1',
                'level' => 1,
                'profit' => 4,
                'customers' => 10,
                'partners' => 2,
                'partner_group' => 10,
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
            ],
            [
                'name' => 'Level 2',
                'level' => 2,
                'profit' => 4,
                'customers' => 10,
                'partners' => 2,
                'partner_group' => 50,
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
            ],
            [
                'name' => 'Level 3',
                'level' => 3,
                'profit' => 4,
                'customers' => 15,
                'partners' => 3,
                'partner_group' => 100,
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
            ],
            [
                'name' => 'Level 4',
                'level' => 4,
                'profit' => 4,
                'customers' => 20,
                'partners' => 3,
                'partner_group' => 500,
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
            ],
            [
                'name' => 'Level 5',
                'level' => 5,
                'profit' => 4,
                'customers' => 25,
                'partners' => 4,
                'partner_group' => 1000,
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
            ],
            [
                'name' => 'Level 6',
                'level' => 6,
                'profit' => 4,
                'customers' => 30,
                'partners' => 4,
                'partner_group' => 5000,
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
            ],
            [
                'name' => 'Level 7',
                'level' => 7,
                'profit' => 4,
                'customers' => 35,
                'partners' => 5,
                'partner_group' => 10000,
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
            ],
            [
                'name' => 'Level 8',
                'level' => 8,
                'profit' => 4,
                'customers' => 40,
                'partners' => 5,
                'partner_group' => 20000,
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
            ],
        ]);
    }
}
