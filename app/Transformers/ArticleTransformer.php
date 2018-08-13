<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
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
		];
	}
}