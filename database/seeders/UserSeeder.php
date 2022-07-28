<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = getAdmin();
        if (!$user) {
           $user = User::create([
                'name' => 'Admin',
                'cnic' => config('app.admin_cnic'),
                'email' => config('app.admin_email'),
                'password' => Hash::make(config('app.admin_password'))
            ]);

            if ($user) {
                $user = User::where('uuid', $user->uuid)->first();
                DB::table('model_has_roles')->where('model_id', $user->id)->delete();
                $user->assignRole('Super Admin');
            }
        }

    }
}
