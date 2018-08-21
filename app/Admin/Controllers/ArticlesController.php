<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ArticlesController extends Controller
{
    use ModelForm;

    protected function catgoryArray()
    {
        $cateArrs = [];

        $categoris = Category::all();
        foreach ($categoris as $category) {
            $cateArrs[$category->id] = $category->name;
        }

        return $cateArrs;
    }

    protected function userArray()
    {
        $userArr = [];

        // 暂时先固定一个人
        $user = User::find(1);
        $userArr[$user->id] = $user->name;

        return $userArr;
    }

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('文章列表');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Show interface.
     *
     * @param $id
     * @return Content
     */
    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('文章详情');
            $content->description('description');

            $content->body(Admin::show(Article::findOrFail($id), function (Show $show) {

                $show->title('文章标题');
                $show->body('文章内容');

                $show->panel()
                    ->tools(function ($tools) {
                        $tools->disableEdit();
                        $tools->disableDelete();
                    });
            }));
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Edit');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('添加文章');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Article::class, function (Grid $grid) {
            // 倒序排列
            $grid->model()->orderBy('created_at', 'desc');

            $grid->id('ID')->sortable();

            $grid->title('标题');

            // 展示关联关系的字段时，使用 column 方法
            $grid->column('category.name', '分类');
            $grid->column('user.name', '作者');

            $grid->visible('是否可见')->display(function ($value) {
                return $value ? '是' : '否';
            });

            $grid->view_count('阅读数');
            $grid->reply_count('留言数');

            $grid->actions(function ($actions) {
                // 禁止删除按钮
                $actions->disableDelete();
            });

            $grid->tools(function ($tools) {
                // 禁止批量删除按钮
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Article::class, function (Form $form) {
            $form->text('title', '文章标题')->rules('required');
            $form->radio('visible', '是否可见')->options([
                '0' => '否',
                '1' => '是',
            ]);
            $form->select('user_id', '文章作者')->options($this->userArray())->rules('required');

            $form->select('category_id', '文章分类')->options($this->catgoryArray())->rules('required');

            $form->image('image', '封面图片')->rules('required|image')->rules('required');
            // 创建一个富文本编辑器
            $form->editor('body', '文章内容')->rules('required');
        });
    }
}
