<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;

class SyncArticleReplyCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xkeyi:sync-article-reply-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '在填充评论数据后更新文章的评论数';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 在命令行打印一行信息
        $this->info('开始同步...');

        $articles = Article::all();

        foreach ($articles as $article) {

            $reply_count = $article->replies()
                                    ->where('visible', true)
                                    ->where('is_deleted', false)
                                    ->count();

            $view_count = $reply_count + random_int(1, 99999);

            $article->update([
                'reply_count' => $reply_count,
                'view_count' => $view_count,
            ]); 
        }

        $this->info('同步生成！');
    }
}
