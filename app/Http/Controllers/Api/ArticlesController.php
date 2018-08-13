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

    	return $this->response->paginator($articles, new ArticleTransformer());
    }
}
