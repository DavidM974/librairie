<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\Livres;
use App\Models\AuthorsModel;
use App\Models\Categories;
use App\Models\CategoriesLivres;
use App\Models\Roles;
use App\Models\User;
use Database\Factories\AuthorsModelFactory;
use Database\Factories\RolesUserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {





        DB::table('roles')->insert([
            'name' => 'ROLE_USER',
            'description' => 'user',
        ]);
        DB::table('roles')->insert([
            'name' => 'ROLE_ADMIN',
            'description' => 'admin',
        ]);
        DB::table('roles')->insert([
            'name' => 'ROLE_AUTHOR',
            'description' => 'auteur',
        ]);

        User::factory(5)->create();
        RolesUserFactory::factory(10)->create();
         
        AuthorsModel::factory(10)->create();
        Livres::factory(10)->create();
        Categories::factory(10)->create();
        CategoriesLivres::factory(30)->create();
    }
}
