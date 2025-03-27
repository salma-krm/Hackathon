<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rule;

class RulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate 10 fake records using the Rule factory
        Rule::factory()->count(10)->create();

        echo "10 fake records inserted into 'rules' table using the factory.\n";
    }
}
