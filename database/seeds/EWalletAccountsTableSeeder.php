<?php

use App\User;
use App\Models\Role;
use App\Models\Currency;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\EWalletAccountStatus;
use Illuminate\Support\Facades\Schema;

class EWalletAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('e_wallet_accounts')->truncate();

        $faker = Faker::create();

        $normal_users = User::doesntHave('roles')->get();

        $e_wallet_account_statuses = EWalletAccountStatus::all();

        $admin_users = User::whereHas('roles', function ($query) {
            $query->where('name', Role::ADMINISTRATOR);
        })->inRandomOrder()->get();

        $currencies = Currency::all();
        
        // Give each normal user an e wallet account
        $normal_users->each(function($normal_user) use($e_wallet_account_statuses, $admin_users, $currencies, $faker) {

            $random_admin_user = $admin_users->random();
            $random_e_wallet_account_status = $e_wallet_account_statuses->random();
            $random_currency = $currencies->random();

            factory(\App\Models\EWalletAccount::class)->create([
                'number' => \Carbon\Carbon::now()->timestamp . $normal_user->id,
                'user_id' => $normal_user->id,
                'balance' => $faker->randomElement([mt_rand(1, 100), mt_rand(200, 1000), mt_rand(60, 1000)]),
                'is_active' => rand(0,1) == 1, 
                'e_wallet_account_status_id' => $random_e_wallet_account_status->id,
                'status_by' => $random_admin_user->id,
                'currency_id' => $random_currency->id,
            ]);

        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
}
