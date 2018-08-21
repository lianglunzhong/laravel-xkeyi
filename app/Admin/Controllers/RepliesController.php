<?php

namespace App\Admin\Controllers;

use App\Models\Reply;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class RepliesController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('留言');
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

            $content->header('Detail');
            $content->description('description');

            $content->body(Admin::show(Reply::findOrFail($id), function (Show $show) {

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

            $content->header('留言编辑');
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

            $content->header('Create');
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
        return Admin::grid(Reply::class, function (Grid $grid) {
            // 倒序排列
            $grid->model()->orderBy('created_at', 'desc');

            $grid->id('ID')->sortable();

            // 展示关联关系的字段时，使用 column 方法
            $grid->column('user.name', '留言者');
            $grid->column('article.title', '留言文章');

            $grid->visible('是否可见')->display(function ($value) {
                return $value ? '是' : '否';
            });
            $grid->is_deleted('是否已删除')->display(function ($value) {
                return $value ? '是' : '否';
            });

            $grid->reply_content('作者回复');

            // 禁用创建按钮，后台不需要创建订单
            $grid->disableCreateButton();
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
        return Admin::form(Reply::class, function (Form $form) {

            $form->text('reply_content', '回复')->rules('required');
            $form->radio('visible', '是否可见')->options([
                '1' => '是',
                '0' => '否',
            ]);
        });
    }
}
