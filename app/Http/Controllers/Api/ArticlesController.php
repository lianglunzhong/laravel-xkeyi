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

    	$query->where('visible', true);

    	$articles = $query->paginate(10);

        // 在返回的 articels 中获取其关联的 user 和 category 时, 只需要在 transformer 中引入，Dingo Api 会自动帮处理掉 N+ 1 的问题
    	return $this->response->paginator($articles, new ArticleTransformer());
    }

    public function show(Article $article)
    {
        if (!$article->visible) {
            return $this->response->errorBadRequest();
        }
        
        return $this->response->item($article, new ArticleTransformer);
    }
}
