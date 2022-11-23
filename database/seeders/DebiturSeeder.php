<?php

namespace Database\Seeders;

use App\Models\Debitur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DebiturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Debitur::factory(10)->create();
    }
}
