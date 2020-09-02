<?php

use App\Models\Retailer;
use App\Models\Administrator;
use App\Scopes\RetailerScope;
use Illuminate\Database\Seeder;
use App\Models\UserAccountStatus;
use App\Scopes\AdministratorScope;

class ModelHasRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $retailers = Retailer::withoutGlobalScope(RetailerScope::class)->limit(45)->get();

        $verified_status = UserAccountStatus::where('name', 'verified')->first();

        $retailers->each(function($retailer) use($verified_status){
            $retailer->update([
                'user_account_status_id' => $verified_status->id,
            ]);
            $retailer->assignRole('retailer'); 
        });

        $administrators = Administrator::withoutGlobalScope(AdministratorScope::class)->limit(7)->get();

        $administrators->each(function($admin) use($verified_status){
            $admin->update([
                'user_account_status_id' => $verified_status->id,
            ]);
            $admin->assignRole('administrator');
        });
    }
}
