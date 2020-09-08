<?php

use App\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\UserAccountStatus;

class ModelHasRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $retailers = User::limit(45)->get();

        $verified_status = UserAccountStatus::where('name', 'verified')->first();

        $retailers->each(function($retailer) use($verified_status){
            $retailer->update([
                'user_account_status_id' => $verified_status->id,
            ]);
            $retailer->assignRole(Role::RETAILER); 
        });

        $administrators = User::limit(7)->get();

        $administrators->each(function($admin) use($verified_status){
            $admin->update([
                'user_account_status_id' => $verified_status->id,
            ]);
            $admin->assignRole(Role::ADMINISTRATOR);
        });
    }
}
