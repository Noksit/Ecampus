<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = 'PHP';
        $category->save();

        $category = new Category();
        $category->name = 'HTML';
        $category->save();

        $category = new Category();
        $category->name = 'WEBMOBILE';
        $category->save();

        $category = new Category();
        $category->name = 'GRAPHISME';
        $category->save();

        $category = new Category();
        $category->name = 'CSS';
        $category->save();

        $category = new Category();
        $category->name = 'RECETTE';
        $category->save();
    }
}
