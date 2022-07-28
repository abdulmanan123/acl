<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lab;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = getAdmin();

        if ($user) {
            $names = ['Physics', 'Chemistry', 'Biology', 'Computer Science', 'Other'];
            foreach($names as $name) {
                Lab::updateOrCreate([
                    'name' => $name,
                    'created_by' => $user->id,
                    'updated_by' => $user->id
                ]);
            }
        }
    }
}
