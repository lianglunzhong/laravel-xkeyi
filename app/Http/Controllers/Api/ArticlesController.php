<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Transformers\ArticleTransformer;

class ArticlesController extends Controller
{
    public function index(Request $request, Article $article)
    {
    	$query = $article->query();

    	if ($category_id = $request->category_id) {
    		$query->where('category_id', $category_id);
    	}

    	$query->where('visible', true)
            ->orderBy('created_at', 'desc');

    	$articles = $query->paginate(10);

        // 在返回的 articels 中获取其关联的 user 和 category 时, 只需要在 transformer 中引入，Dingo Api 会自动帮处理掉 N+ 1 的问题
    	return $this->response->paginator($articles, new ArticleTransformer());
    }

    public function show(Article $article)
    {
        if (!$article->visible) {
            return $this->response->errorBadRequest();
        }

        // 同步有效评论数（待后台操作写好之后可删除此步骤）
        $avial_count = $article->availReplies()->count();
        $article->update([
            'reply_count' => $avial_count,
        ]);

        $article->increment('view_count', 1);
        
        return $this->response->item($article, new ArticleTransformer);
    }
}
