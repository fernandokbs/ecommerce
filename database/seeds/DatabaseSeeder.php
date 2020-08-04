<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(User::count() == 0) 
        {
            factory(User::class, 1)->create([
                'name' => 'Fernando',
                'email' => 'fernando@codigofacilito.com',
                'admin' => true
            ]);

            factory(Product::class, 5)->create();
        }
    }
}
