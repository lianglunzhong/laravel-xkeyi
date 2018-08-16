<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{

	protected $availableIncludes = [
		'user',
		'category',
	];

	public function transform(Article $article)
	{	
		return [
			'id' => $article->id,
			'title' => $article->title,
			'body' => $article->body,
			'user_id' => $article->user_id,
			'category_id' => $article->category_id,
			'view_count' => $article->view_count,
			'reply_count' => $article->reply_count,
			'created_at' => $article->created_at->toDateTimeString(),
			'updated_at' => $article->updated_at->toDateTimeString(),
		];
	}

	public function includeUser(Article $article)
	{
		// 在 Transformer 中，我们可以使用：
        // $this->item() 返回单个资源
        //$this->collection() 返回集合资源
        return $this->item($article->user, new UserTransformer());
	}

	public function includeCategory(Article $article)
	{
		return $this->item($article->category, new CategoryTransformer());
	}
}