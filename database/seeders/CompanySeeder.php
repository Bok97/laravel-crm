<?php

namespace Database\Seeders;

use App\Models\Company;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            Company::create([
                'name' => $faker->company,
                'email' => $faker->unique()->companyEmail,
                'website' => $faker->domainName,
            ]);
        }
    }
}
