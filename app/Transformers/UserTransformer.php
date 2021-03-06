<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
	public function transform(User $user)
	{
		return [
			'id' => $user->id,
			'name' => $user->name,
			'avatar' => $user->avatar,
			'avatar_url' => $user->avatar_url,
			'introduction' => $user->introduction,
		];
	}
}