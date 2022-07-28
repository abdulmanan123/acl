<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AreaType;

class AreaTypeSeeder extends Seeder
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
            $names = ['Canal', 'Marla', 'Square Feet'];
            foreach($names as $name) {
                AreaType::updateOrCreate([
                    'name' => $name,
                    'created_by' => $user->id,
                    'updated_by' => $user->id
                ]);
            }
        }
    }
}
