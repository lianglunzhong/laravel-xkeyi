<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\User;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 填充分类
        $categories = [
            [
                'name' => 'IT 技术',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'visible' => true,
            ],
            [
                'name' => '生活艺术',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'visible' => true,
            ],
            [
                'name' => '运动健身',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'visible' => true,
            ],
            [
                'name' => '影视赏析',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'visible' => true,
            ],
            [
                'name' => '这个漫画很邪恶',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'visible' => true,
            ],
            [
                'name' => '其他',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'visible' => false,
            ]
        ];

        Category::insert($categories);
        // DB::table('categories')->insert($categories);
        
        // 填充一个用户数据
        $user = new User();
        $user->name = 'KekeO';
        $user->avatar = 'images/static/kekeo.jpg';
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
