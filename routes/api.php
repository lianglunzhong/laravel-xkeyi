<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
	'namespace' => 'App\Http\Controllers\Api',
    'middleware' => ['serializer:array', 'bindings'], // serializer:array 减少一次返回数据的嵌套; bindings 把dingo api路由的参数自动绑定到模型上
], function($api) {
	$api->get('version', function() {
        return response('this is xkeyi api version v1');
    });

    $api->group([
    	'middleware' => 'api.throttle', // 调用频率限制
    	'limit' => config('api.rate_limits.access.limit'), // 次数
    	'expires' => config('api.rate_limits.access.expires'), // 分钟
    ], function($api) {
    	/** 游客可以访问的接口 */
        // 分类列表
        $api->get('categories', 'CategoriesController@index')
        	->name('api.categories.index');

        // 文章列表
        $api->get('articles', 'ArticlesController@index')
            ->name('api.articles.index');

        // 文章详情
        $api->get('articles/{article}', 'ArticlesController@show')
            ->name('api.articles.show');
    });
});
