<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplicationType;

class ApplicationTypeSeeder extends Seeder
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
            $names = ['Degree College', 'LLB', 'DPT College', 'BS Programs'];
            foreach($names as $name) {
                ApplicationType::updateOrCreate([
                    'name' => $name,
                    'created_by' => $user->id,
                    'updated_by' => $user->id
                ]);
            }
        }
    }
}
