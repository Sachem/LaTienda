<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CatalogProduct;
use App\CatalogCategory;
use App\User;
use App\Page;

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
        Eloquent::unguard();

         $this->call(CatalogCategoryTableSeeder::class);
         $this->call(CatalogProductTableSeeder::class);
         $this->call(UserTableSeeder::class);
         $this->call(PageTableSeeder::class);

         Eloquent::reguard();
        Model::reguard();
    }
}

class CatalogCategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('catalog_categories')->delete();

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
        DB::table('catalog_products')->delete();

        CatalogProduct::create(array('name' => 'Porshe 911', 'category_id' => 2, 'price' => 700000, 'description' => 'This is a classic model of Porshe, legend 911. Blah blah Blah blah Blah blah Blah blah.<br /><br />Blah blah Blah blah Blah blah Blah blah Blah blah Blah blah.'));
        CatalogProduct::create(array('name' => 'BMW X6', 'category_id' => 2, 'price' => 320000, 'description' => 'Nice Pseudo-SUV model of BMW. Nice Pseudo-SUV model of BMW. Nice Pseudo-SUV model of BMW. <br /><br />Nice Pseudo-SUV model of BMW. Nice Pseudo-SUV model of BMW. Nice Pseudo-SUV model of BMW. Nice Pseudo-SUV model of BMW.'));
        CatalogProduct::create(array('name' => 'Jaguar', 'category_id' => 2, 'price' => 200000, 'description' => 'Description'));
        CatalogProduct::create(array('name' => 'Maclaren F1', 'category_id' => 2, 'price' => 2500000, 'description' => 'Description'));
        CatalogProduct::create(array('name' => 'Lamborghini Diablo', 'category_id' => 2, 'price' => 2000000, 'description' => 'Description'));
        CatalogProduct::create(array('name' => 'BMW 318i', 'category_id' => 2, 'price' => 10000, 'description' => 'Description'));
        CatalogProduct::create(array('name' => 'Mercedes 550CL', 'category_id' => 2, 'price' => 100000, 'description' => 'Description'));
        
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(
            array('username' => 'Sachem', 'email' => 'sachem1000@yahoo.com', 'password' => '$2y$10$0sqzolf9mRa4Qrz71Zsuje/QNbFN1MAWT8fFzKioMkbS9x0u6ceW2', 'admin' => 1)
        );
        User::create(
            array('username' => 'Client1', 'email' => 'client@mail.com', 'password' => '$2y$10$O0ImMoC86PrRERhYjXR4leZEZWtTXhLdsSfOMCz/jTBLY.p2U20eO', 'admin' => 0)
        );
    }

}

class PageTableSeeder extends Seeder {

    public function run()
    {
        DB::table('pages')->delete();

        Page::create(
            array('user_id' => 1, 'title' => 'Contact', 'content' => '<h1>Contact form</h1>blah blah <br />blah blah <br />blah blah <br /><br />SEND', 'visible' => 1)
        );
    }

}