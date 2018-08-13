<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 所有用户 ID， 如：[1,2,3,4]
        $user_ids = User::all()->pluck('id')->toArray();

        // 所有分类 ID， 如：[1,2,3,4]
        $category_ids = Category::all()->pluck('id')->toArray();

        // 获取 faker 实例
        $faker = app(Faker\Generator::class);

        $articles = factory(Article::class)
        				->times(100)
        				->make()
        				->each(function ($article, $index)
        					use ($user_ids, $category_ids, $faker)
        {
        	// 从用户 ID 数组中随机取出一个并赋值
            $article->user_id = $faker->randomElement($user_ids);
            // 从分类 ID 数组中随机取出一个并赋值
            $article->category_id = $faker->randomElement($category_ids);
        });

        Article::insert($articles->toArray());
    }
}
