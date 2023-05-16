<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Kangaroo;
use Illuminate\Database\Seeder;

class KangarooSeeder extends Seeder
{
    public function run(): void
    {
        Kangaroo::factory()->count(50)->create();
    }
}
