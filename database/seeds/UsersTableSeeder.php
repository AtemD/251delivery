<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        factory(App\User::class, 105)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
