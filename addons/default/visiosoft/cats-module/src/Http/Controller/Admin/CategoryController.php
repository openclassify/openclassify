<?php namespace Visiosoft\CatsModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Image\Command\MakeImageInstance;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryModel;
use Illuminate\Http\Request;
use Sunra\PhpSimple\HtmlDomParser;
use Visiosoft\CatsModule\Category\CategoryCollection;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\CatsModule\Category\Form\CategoryFormBuilder;
use Visiosoft\CatsModule\Category\Table\CategoryTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class CategoryController extends AdminController
{
    public function index(CategoryTableBuilder $table, Request $request)
    {
        if ($this->request->action == "delete") {
            $CategoriesModel = new CategoryModel();
            foreach ($this->request->id as $item) {
                $CategoriesModel->deleteSubCategories($item);
            }
        }
        if (!isset($request->cat) || $request->cat == "") {
            $categories = CategoryModel::query()->where('parent_category_id', '')->orWhereNull('parent_category_id')->get();
            $categories = $categories->where('deleted_at', null);
        } else {
            $categories = CategoryModel::query()->where('parent_category_id', $request->cat)->whereNull('deleted_at')->get();
        }
        if (count($categories) == 0 and isset($request->cat) || $request->cat != "") {
            $this->messages->error('Selected category has no sub-categories.');
            return back();
        }
        $table->setTableEntries($categories);
        return $table->render();
    }

    public function create(CategoryFormBuilder $form, Request $request)
    {
        if ($this->request->action == "save") {
            $all = $this->request->all();
            $id = $all['parent_category'];
            $k = 1;
            for ($i = 0; $i < $k; $i++) {
                $cat1 = CategoryModel::query()->where('cats_category.id', $id)->first();
                if ($cat1 != null) {
                    $id = $cat1->parent_category_id;
                    $k++;
                }
            }
            if ($i >= 7) {
                $this->messages->error('You have reached your sub-category limit, you can only add 5 sub-categories.');

                return $this->redirect->back();
            }

            $form->make();
            if ($form->hasFormErrors()) {
                return $this->redirect->to('/admin/cats/create');
            }
            return $this->redirect->to('/admin/cats');
        } else {
            $form->setFields(['name']);
            $form->setActions(['save']);
            $formBuilder = $form;
            $nameField = HTMLDomParser::str_get_html($form->render()->getContent());
            $nameField = $nameField->find('.name', 0);
            if ($nameField !== null) {
                $nameField = $nameField->innertext();
            } else {
                $nameField = "";
            }
        }


        return $this->view->make('visiosoft.module.cats::cats/admin-cat', compact('nameField', 'formBuilder'));
    }


    public function edit(CategoryFormBuilder $form, Request $request, $id)
    {
        if ($request->action == "update") {
            $form->make($id);
            if ($form->hasFormErrors()) {
                return $this->redirect->back();
            }
        } else {
            $form->setFields(['name']);
            $nameField = HTMLDomParser::str_get_html($form->render($id)->getContent());
            $nameField = $nameField->find('.name', 0);
            if ($nameField !== null) {
                $nameField = $nameField->innertext();
            } else {
                $nameField = "";
            }
        }

        return $this->view->make('visiosoft.module.cats::cats/admin-cat', compact('nameField'))->with('id', $id);
    }

    public function delete(CategoryCollection $categoryCollection, CategoryModel $categoryModel, $id)
    {
        echo "<div style='background-image:url(" . $this->dispatch(new MakeImageInstance('visiosoft.theme.default::images/loading_anim.gif', 'img'))->url() . ");
        background-repeat:no-repeat;
        background-size: 300px;
        background-position:center;
        text-align:center;
        width:98%;
        height:100%;    
        padding-left: 20px;'><h3>" . trans('visiosoft.module.cats::field.please_wait') . "</h3></div>";
        $Find_Categories = $categoryModel
            ->where('deleted_at', null)
            ->find($id);
        if ($Find_Categories != "") {
            $categoryCollection->subCatDelete($id);
            header("Refresh:0");
        } else {
            $categoryModel->find($id)->delete();
            return redirect('admin/cats')->with('success', ['Category and related sub-categories deleted successfully.']);
        }

    }
}
