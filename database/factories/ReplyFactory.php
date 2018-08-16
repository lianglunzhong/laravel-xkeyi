<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reply::class, function (Faker $faker) {
    // 随机取一个月以内的时间
	$updated_at = $faker->dateTimeThisMonth();
	// 传参为生成的最大时间
	$created_at = $faker->dateTimeThisMonth($updated_at);

    return [
        'content' => $faker->text(),
        'reply_content' => $faker->text(),
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
