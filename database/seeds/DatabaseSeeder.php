<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CatalogProduct;
use App\CatalogCategory;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call(CatalogCategoryTableSeeder::class);
         $this->call(CatalogProductTableSeeder::class);
         $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}

class CatalogCategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('catalog_category')->delete();

        CatalogCategory::create(array('name' => 'Cars'));
        CatalogCategory::create(array('name' => 'Sport Cars', 'parent_id' => 1));
        CatalogCategory::create(array('name' => 'Racing Cars', 'parent_id' => 2));
        CatalogCategory::create(array('name' => 'Street Sports Cars', 'parent_id' => 2));
        CatalogCategory::create(array('name' => 'Luxury Cars', 'parent_id' => 1));
        CatalogCategory::create(array('name' => 'SUVs', 'parent_id' => 1));
        CatalogCategory::create(array('name' => 'Boats'));
        CatalogCategory::create(array('name' => 'Holiday'));
    }

}

class CatalogProductTableSeeder extends Seeder {

    public function run()
    {
        DB::table('catalog_product')->delete();

        CatalogProduct::create(array('name' => 'Porshe 911', 'category_id' => 2, 'price' => 700000, 'description' => 'This is a classic model of Porshe, legend 911. Blah blah Blah blah Blah blah Blah blah.<br /><br />Blah blah Blah blah Blah blah Blah blah Blah blah Blah blah.'));
        CatalogProduct::create(array('name' => 'BMW X6', 'category_id' => 2, 'price' => 320000, 'description' => 'Nice Pseudo-SUV model of BMW. Nice Pseudo-SUV model of BMW. Nice Pseudo-SUV model of BMW. <br /><br />Nice Pseudo-SUV model of BMW. Nice Pseudo-SUV model of BMW. Nice Pseudo-SUV model of BMW. Nice Pseudo-SUV model of BMW.'));
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(
            array('username' => 'Sachem', 'email' => 'sachem1000@yahoo.com', 'password' => '$2y$10$0sqzolf9mRa4Qrz71Zsuje/QNbFN1MAWT8fFzKioMkbS9x0u6ceW2')
        );
    }

}