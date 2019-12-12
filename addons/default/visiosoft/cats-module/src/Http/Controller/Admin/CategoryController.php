<?php namespace Visiosoft\CatsModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Image\Command\MakeImageInstance;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryTranslationsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Sunra\PhpSimple\HtmlDomParser;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\Form\CategoryFormBuilder;
use Visiosoft\CatsModule\Category\Table\CategoryTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class CategoryController extends AdminController
{
    private $categoryRepository;
    private $categoryEntryTranslationsModel;
    private $str;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        CatsCategoryEntryTranslationsModel $categoryEntryTranslationsModel,
        Str $str
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryEntryTranslationsModel = $categoryEntryTranslationsModel;
        $this->str = $str;
        parent::__construct();
    }

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
            $parent_id = $all['parent_category'];
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

            $locale = $this->getRequestLang($all);

            $translatable = array();
            foreach ($all as $key => $value) {
                foreach ($locale as $lang) {
                    if ($this->endsWith($key, "_$lang") && !in_array(substr($key, 0, -3), $translatable)) {
                        $translatable[] = substr($key, 0, -3);
                    }
                }
            }
            $translatableEntries = array();
            foreach ($locale as $lang) {
                $translatableEntries[$lang] = array();
                foreach ($translatable as $translatableEntry) {
                    $translatableEntries[$lang][$translatableEntry] = $all[$translatableEntry . '_' . $lang];
                }
            }

            // Check if there is multiple categories in the name filed
            $isMultiCat = array();
            foreach ($translatableEntries as $key => $translatableEntry) {
                $multiCat = explode(",", $translatableEntry['name']);
                if (count($multiCat) > 1) {
                    $firstArray = array();
                    foreach ($multiCat as $cat) {
                        $secondArray = array();
                        foreach ($locale as $lang) {
                            if ($key === $lang) {
                                $secondArray[$key]['name'] = trim($cat);
                            }
                        }
                        array_push($firstArray, $secondArray);
                    }
                    array_push($isMultiCat, $firstArray);
                }
            }
            if (empty($isMultiCat)) {
                $this->categoryRepository->create(array_merge($translatableEntries, [
                    'slug' => $all['slug'],
                    'parent_category' => $all['parent_category'] === "" ? null : $all['parent_category'],
                    'icon' => $all['icon'],
                    'seo_keyword' => $all['seo_keyword'],
                    'seo_description' => $all['seo_description'],
                ]));
            } else {
                for ($i = 0; $i < count($isMultiCat[0]); $i++) {
                    foreach ($isMultiCat as $cat) {
                        $translatableEntries = array_merge($translatableEntries, $cat[$i]);
                    }
                    $this->categoryRepository->create(array_merge($translatableEntries, [
                        'slug' => $this->str->slug(reset($translatableEntries)['name'], '_'),
                        'parent_category' => $all['parent_category'] === "" ? null : $all['parent_category'],
                        'icon' => $all['icon'],
                        'seo_keyword' => $all['seo_keyword'],
                        'seo_description' => $all['seo_description'],
                    ]));
                }
            };

//            $this->categoryRepository->create(array_merge($translatableEntries, [
//                'slug' => $all['slug'],
//                'parent_category' => $all['parent_category'],
//                'icon' => $all['icon'],
//                'seo_keyword' => $all['seo_keyword'],
//                'seo_description' => $all['seo_description'],
//            ]));

//            $form->make();
//            if ($form->hasFormErrors()) {
//                return $this->redirect->to('/admin/cats/create');
//            }
            if ($parent_id != "") {
                return $this->redirect->to('/admin/cats?cat=' . $parent_id);
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

    public function endsWith($string, $test) {
        $strlen = strlen($string);
        $testlen = strlen($test);
        if ($testlen > $strlen) return false;
        return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
    }

    public function getRequestLang($request) {
        $locale = array();
        foreach ($request as $key => $field) {
            $locale[] = substr($key, 0, -2);
        }
        $notTrans = array();
        $trans = array();
        foreach ($locale as $translatable) {
            if (!in_array($translatable, $notTrans)) {
                $notTrans[] = $translatable;
            } else {
                $trans[] = $translatable;
            }
        }
        $locale = array();
        foreach ($request as $key => $field) {
            foreach (array_unique($trans) as $entry) {
                if (strpos($key, $entry) === 0) {
                    $locale[] = substr($key, -2);
                }
            }
        }
        return $locale;
    }

    public function edit(CategoryFormBuilder $form, Request $request, $id)
    {
        if ($request->action == "update") {
            $form->make($id);
            if ($form->hasFormErrors()) {
                return $this->redirect->back();
            }
            $parent = $request->parent_category;
            if ($parent != "") {
                return $this->redirect->to('/admin/cats?cat=' . $parent);
                die;
            }
            return $this->redirect->to('/admin/cats');
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

    public function delete(CategoryRepositoryInterface $categoryRepository, Request $request, CategoryModel $categoryModel, $id)
    {
        $categoryRepository->DeleteCategories($id);
        if ($request->parent == "")
            return redirect('admin/cats')->with('success', ['Category and related sub-categories deleted successfully.']);
        else
            return redirect('admin/cats?cat=' . $request->parent)->with('success', ['Category and related sub-categories deleted successfully.']);
    }

    public function cleanSubcats()
    {
        $cats = $this->categoryRepository->all();
        $deletedCatsCount = 0;
        foreach ($cats as $cat) {
            $parentCatId = $cat->parent_category_id;
            $parentCat = $this->categoryRepository->find($parentCatId);
            if (is_null($parentCat) && !is_null($parentCatId)) {
                $this->categoryEntryTranslationsModel->where('entry_id', $cat->id)->delete();
                $this->categoryRepository->DeleteCategories($cat->id);
                $deletedCatsCount++;
            }
        }
        return redirect('admin/cats')->with('success', [$deletedCatsCount . ' categories has been deleted.']);
    }


}
