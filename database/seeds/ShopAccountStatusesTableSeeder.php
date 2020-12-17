<?php

use App\Models\ShopAccountStatus;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopAccountStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('shop_account_statuses')->truncate();

        factory(ShopAccountStatus::class)->create([
            'name' => Shop::VERIFIED_SHOP,
            'description' => 'shop account is verified',
            'color' => 'success'
        ]);
        factory(ShopAccountStatus::class)->create([
            'name' => Shop::UNVERIFIED_SHOP,
            'description' => 'shop account is verified',
            'color' => 'secondary'
        ]);
        factory(ShopAccountStatus::class)->create([
            'name' => Shop::DEACTIVATED_SHOP,
            'description' => 'shop account is deactivated',
            'color' => 'danger'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
