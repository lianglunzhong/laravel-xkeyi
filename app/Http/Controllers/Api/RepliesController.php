<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\ReplyRequest;
use App\Transformers\ReplyTransformer;
use App\Models\Article;
use App\Models\Reply;

class RepliesController extends Controller
{
    public function store(ReplyRequest $request, Article $article, Reply $reply)
    {
    	$reply->content = $request->content;
    	$reply->article_id = $article->id;
    	$reply->user_id = $this->user()->id;
    	$reply->save();

    	$article->increment('reply_count', 1);

    	return $this->response->item($reply, new ReplyTransformer())->setStatusCode(201);
    }

    public function destroy(Article $article, Reply $reply)
    {
    	if ($reply->article_id != $article->id) {
    		return $this->response->errorBadRequest();
    	}

    	$this->authorize('own', $reply);

    	$reply->update(['is_deleted' => true]);

    	$article->decrement('reply_count', 1);

    	return $this->response->noContent();
    }
}
