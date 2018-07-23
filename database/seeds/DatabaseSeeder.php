<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* $this->call(UserRoleTableSeeder::class);
         $this->call(LanguageTableSeeder::class);
         $this->call(PermissionTableSeeder::class);
		 $this->call(SettingTableSeeder::class);*/
         //$this->call(ProductStatusTableSeeder::class);

         //Seeder temporary
        // factory(\App\ProductStatus::class)->create([
        //     'id' => 1,
        //     'status' => 'Activé'
        // ]);
        // factory(\App\ProductStatus::class)->create([
        //     'id' => 2,
        //     'status' => 'Désactivé'
        // ]);
       
        // factory(\App\StoreOpeningDay::class)->create([
        //     'opening_day_id' => 1,
        //     'day_name' => 'lundi'
        // ]);
        // factory(\App\StoreOpeningDay::class)->create([
        //     'opening_day_id' => 2,
        //     'day_name' => 'mardi'
        // ]);
        // factory(\App\StoreOpeningDay::class)->create([
        //     'opening_day_id' => 3,
        //     'day_name' => 'mercredi'
        // ]);
        // factory(\App\StoreOpeningDay::class)->create([
        //     'opening_day_id' => 4,
        //     'day_name' => 'jeudi'
        // ]);
        // factory(\App\StoreOpeningDay::class)->create([
        //     'opening_day_id' => 5,
        //     'day_name' => 'vendredi'
        // ]);
        // factory(\App\StoreOpeningDay::class)->create([
        //     'opening_day_id' => 6,
        //     'day_name' => 'samedi'
        // ]);
        // factory(\App\StoreOpeningDay::class)->create([
        //     'opening_day_id' => 7,
        //     'day_name' => 'dimanche'
        // ]);
        
        factory(\App\Models\ProductStockStatus::class)->create([
            'product_stock_status_id' => 1,
            'status_name' => 'En Stock'
        ]);
        factory(\App\Models\ProductStockStatus::class)->create([
            'product_stock_status_id' => 2,
            'status_name' => 'Dernier article'
        ]);
        factory(\App\Models\ProductStockStatus::class)->create([
            'product_stock_status_id' => 3,
            'status_name' => 'En Rupture'
        ]);
    }
}
