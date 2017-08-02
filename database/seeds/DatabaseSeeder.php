<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //$this->call(CategoriesTableSeeder::class);
        Model::unguard();
        // Clear cache
        Artisan::call('cache:clear');
        $this->call('CategoriesTableSeeder');
    }
}
