<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Reply;
use App\Models\Article;

class ReplyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 所有用于 ID 数组
        $user_ids = User::all()->pluck('id')->toArray();

        // 所有的话题 ID 数组
        $article_ids = Article::all()->pluck('id')->toArray();

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $replys = factory(Reply::class)
                        ->times(1000)
                        ->make()->each(function ($reply, $index)
                        use ($user_ids, $article_ids, $faker)
        {
            // 从用户 ID 数组中随机取出一个饼赋值
            $reply->user_id = $faker->randomElement($user_ids);

            // 从话题 ID 数组中随机取出一个饼赋值
            $reply->article_id = $faker->randomElement($article_ids);
        });

        // 将数据集合转换为数组，并插入到数据库中
        Reply::insert($replys->toArray());
    }
}
