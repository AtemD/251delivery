<?php

use App\Models\EWalletAccountStatus;
use Illuminate\Database\Seeder;

class EWalletAccountStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(EWalletAccountStatus::class)->create([
            'name' => EWalletAccountStatus::VERIFIED_ACCOUNT,
            'description' => 'wallet account is verified',
            'color' => 'success'
        ]);
        factory(EWalletAccountStatus::class)->create([
            'name' => EWalletAccountStatus::UNVERIFIED_ACCOUNT,
            'description' => 'wallet account is unverified',
            'color' => 'secondary'
        ]);
        factory(EWalletAccountStatus::class)->create([
            'name' => EWalletAccountStatus::DEACTIVATED_ACCOUNT,
            'description' => 'wallet account is deactivated',
            'color' => 'danger'
        ]);

        // Other statuses based on activity: dormant, active
    }
}
