<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        Company::all()->each(function ($company) use ($faker) {
            foreach (range(1, 20) as $index) {
                Employee::create([
                    'company_id' => $company->id,
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'email' => $faker->unique()->safeEmail,
                    'phone' => $faker->phoneNumber,
                ]);
            }
        });
    }
}
