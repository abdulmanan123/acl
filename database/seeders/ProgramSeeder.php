<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
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
            $names = ['Intermediate', 'Bachelor Classes', 'Masters'];
            foreach($names as $name) {
                Program::updateOrCreate([
                    'name' => $name,
                    'created_by' => $user->id,
                    'updated_by' => $user->id
                ]);
            }
        }
    }
}
