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
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('model_has_roles')->truncate();

        // $super_admin = User::findOrFail(1);
        // $super_admin->assignRole(Role::SUPER_ADMINISTRATOR);

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

        // Create one user to be give super admin role
        factory(User::class)->create([
            'first_name' => 'Daniel',
            'last_name' => 'Monday'
        ]);

        // Give one user super admin role.
        $user = User::where('last_name', 'Monday')->firstOrFail();
        $user->assignRole(Role::SUPER_ADMINISTRATOR);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
