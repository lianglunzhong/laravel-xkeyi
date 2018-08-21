<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CategoriesController extends Controller
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

            $content->header('分类列表');
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

            $content->header('查看分类');
            $content->description('description');

            $content->body(Admin::show(Category::findOrFail($id), function (Show $show) {

                $show->name('标题');
                $show->description('描述');
                $show->visible('是否可见')->as(function ($value) {
                    return $value ? '是' : '否';
                });

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

            $content->header('修改分类');
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

            $content->header('新增分类');
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
        return Admin::grid(Category::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->name('分类名称');
            $grid->visible('是否可见')->display(function ($value) {
                return $value ? '是' : '否';
            });

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
        return Admin::form(Category::class, function (Form $form) {

            $form->text('name', '分类名称')->rules('required');
            $form->text('description');
            $form->radio('visible', '是否可见')->options([
                '0' => '否',
                '1' => '是',
            ]);
        });
    }
}
