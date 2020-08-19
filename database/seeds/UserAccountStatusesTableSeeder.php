<?php

use App\User;
use App\Models\UserAccountStatus;
use Illuminate\Database\Seeder;

class UserAccountStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserAccountStatus::class)->create([
            'name' => User::VERIFIED_USER,
            'description' => 'user account is verified',
            'color' => 'success'
        ]);
        factory(UserAccountStatus::class)->create([
            'name' => User::UNVERIFIED_USER,
            'description' => 'user account is verified',
            'color' => 'secondary'
        ]);
        factory(UserAccountStatus::class)->create([
            'name' => User::DEACTIVATED_USER,
            'description' => 'user account is deactivated',
            'color' => 'danger'
        ]);
    }
}
