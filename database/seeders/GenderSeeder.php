<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gender;

class GenderSeeder extends Seeder
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
            $names = ['Male', 'Female', 'Other'];
            foreach($names as $name) {
                Gender::updateOrCreate([
                    'name' => $name,
                    'created_by' => $user->id,
                    'updated_by' => $user->id
                ]);
            }
        }
    }
}
