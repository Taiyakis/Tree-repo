<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testable = array(
            [3, "WEB", 0],
            [9, "Angular 5", 0],
            [4, "APP", 0],
            [5, "PHP", 3],
            [6, "Js", 3],
            [14, "Python", 4],
            [13, "Java", 4],
            [12, "C#", 4],
            [11, "Lumen", 5],
            [10, "Laravel", 5],
            [8, "ExpressJs", 6],
            [7, "NodeJs", 6],
            [15, "Spring MVC", 13],
        );

        for($i = 0 ; $i<count($testable); $i++)
        {
            $cat = new Category;
            $cat->id = $testable[$i][0];
            $cat->cat_name = $testable[$i][1];
            $cat->parent_id = $testable[$i][2];
            $cat->save();
        }
    }
}
