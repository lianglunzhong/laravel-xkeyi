<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Transformers\UserTransformer;
use App\Http\Requests\Api\WeappAuthorizationRequest;

class UsersController extends Controller
{
    public function me()
    {
    	// 获取当前登录的用户，也就是 token 所对应的用户，$this->user() 等同于\Auth::guard('api')->user()
    	return $this->response->item($this->user(), new UserTransformer());
    }


    public function update(WeappAuthorizationRequest $request)
    {
    	$user = Auth::guard('api')->user();

    	$attributes = $request->only(['name', 'avatar']);

        \Log::debug('lianglunzhong', $attributes);

    	$user->update($attributes);

    	return $this->response->item($user, new UserTransformer());
    }
}
