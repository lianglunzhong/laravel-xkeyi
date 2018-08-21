<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    // 分类
    $router->resource('categories', 'CategoriesController');
    // 文章
    $router->resource('articles', 'ArticlesController');
    // 留言
    $router->resource('replies', 'RepliesController');

});
