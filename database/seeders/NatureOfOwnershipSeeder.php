<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NatureOfOwnership;

class NatureOfOwnershipSeeder extends Seeder
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
            $names = ['Individual', 'Partnership', 'College Chain', 'Trust', 'NGO', 'Missionary'];
            foreach($names as $name) {
                NatureOfOwnership::updateOrCreate([
                    'name' => $name,
                    'created_by' => $user->id,
                    'updated_by' => $user->id
                ]);
            }
        }
    }
}
