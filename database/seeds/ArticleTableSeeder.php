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

        // 文章封面图片
        $images = [
            'https://lccdn.phphub.org/uploads/images/201802/28/1/Jk8mC7SGI5.jpg?imageView2/1/w/600/h/296',
            'https://lccdn.phphub.org/uploads/images/201803/08/1/mIpeaUvQ7Y.jpeg?imageView2/1/w/600/h/296',
            'https://lccdn.phphub.org/uploads/images/201801/24/1/rgMAkwm5JX.jpeg?imageView2/1/w/600/h/296',
            'https://lccdn.phphub.org/uploads/images/201806/21/1/gH3fzveyW3.jpg?imageView2/1/w/600/h/296',
            'https://lccdn.phphub.org/uploads/images/201803/19/1/lDtmqCGQJJ.jpeg?imageView2/1/w/600/h/296',
            'https://lccdn.phphub.org/uploads/images/201803/13/1/DCYvMliGXu.jpg?imageView2/1/w/600/h/296',
        ];

        // 获取 faker 实例
        $faker = app(Faker\Generator::class);

        $articles = factory(Article::class)
        				->times(100)
        				->make()
        				->each(function ($article, $index)
        					use ($user_ids, $category_ids, $images, $faker)
        {
        	// 从用户 ID 数组中随机取出一个并赋值
            $article->user_id = $faker->randomElement($user_ids);
            // 从分类 ID 数组中随机取出一个并赋值
            $article->category_id = $faker->randomElement($category_ids);
            // 从图片数组总随机取出一个并赋值
            $article->image = $faker->randomElement($images);
        });

        Article::insert($articles->toArray());
    }
}
