<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        $this->call(OrderTypesTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(ShopTypesTableSeeder::class);
        $this->call(ShopsTableSeeder::class);

        $this->call(CountriesTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);

        $this->call(CuisinesTableSeeder::class);

        $this->call(SectionsTableSeeder::class);
        $this->call(TaxesTableSeeder::class);
        $this->call(DiscountsTableSeeder::class);
        
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductHasTaxTableSeeder::class);
        $this->call(ProductHasDiscountTableSeeder::class);

        $this->call(OrdersTableSeeder::class);
        $this->call(OrderHasProductTableSeeder::class);
        
        $this->call(LocationsTableSeeder::class);
    }
}
