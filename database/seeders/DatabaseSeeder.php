<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ApplicationTypeSeeder::class,
            AreaTypeSeeder::class,
            DistrictSeeder::class,
            EducationLevelSeeder::class,
            GenderSeeder::class,
            LabSeeder::class,
            LocationSeeder::class,
            NatureOfOwnershipSeeder::class,
            QualificationSeeder::class,
            ProgramSeeder::class,
            ShiftSeeder::class,
        ]);
    }
}
