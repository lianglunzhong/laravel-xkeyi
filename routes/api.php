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

        // 获取 about me 页面的两篇文章
        $api->get('article/about_me', 'ArticlesController@aboutMe')
            ->name('api.articel.about_me');

        // 文章详情
        $api->get('articles/{article}', 'ArticlesController@show')
            ->name('api.articles.show');

        // 小程序登录
        $api->post('weapp/authorizations', 'AuthorizationsController@weappStore')
            ->name('api.weapp.authorizations.store');

        // 刷新token
        $api->put('authorizations/current', 'AuthorizationsController@update')
            ->name('api.authorizations.update');

        /** 需要 token 验证的接口 */
        $api->group(['middleware' => 'api.auth'], function($api) {
            // 当前登录用户信息
            $api->get('user', 'UsersController@me')
                ->name('api.user.show');

            // put:替换某个资源，需提供完整的资源信息 patch: 部分修改资源，提供部分资源信息
            // 更新用户信息
            $api->patch('user', 'UsersController@update')
                ->name('api.user.update');
            // 因为微信小程序的网络请求是不支持 PATCH 方法的
            $api->put('user', 'UsersController@update')
                ->name('api.user.update');

            // 发布留言
            $api->post('articles/{article}/replies', 'RepliesController@store')
                ->name('api.articles.replies.store');

            // 删除留言
            $api->delete('articles/{article}/replies/{reply}', 'RepliesController@destroy')
                ->name('api.articles.replies.destroy');
        });
    });
});
