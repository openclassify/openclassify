<?php namespace Visiosoft\CatsModule\Http\Controller\Admin;

use Anomaly\FilesModule\File\FileSanitizer;
use Anomaly\FilesModule\File\FileUploader;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryTranslationsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Flysystem\MountManager;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\CatsModule\Category\Command\CalculateAdsCount;
use Visiosoft\CatsModule\Category\Command\CalculateCategoryLevel;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\Form\CategoryFormBuilder;
use Visiosoft\CatsModule\Category\Table\CategoryTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\CatsModule\Category\Traits\DeleteCategory;

class CategoryController extends AdminController
{
    private $categoryRepository;
    private $categoryEntryTranslationsModel;
    private $str;

    use DeleteCategory;

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
        if ($request->view != "trash") {
            $table->setTableEntries($categories);
        }

        return $table->render();
    }

    public function create(FileUploader $uploader, FolderRepositoryInterface $folderRepository, MountManager $manager)
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
            if ($i > 10) {
                $this->messages->error('You have reached your sub-category limit, you can only add 9 sub-categories.');

                return $this->redirect->back();
            }

            $locale = config('streams::locales.enabled');

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
                $category = $this->categoryRepository->create(array_merge($translatableEntries, [
                    'slug' => $all['slug'],
                    'parent_category' => $all['parent_category'] === "" ? null : $all['parent_category'],
                    'seo_keyword' => $all['seo_keyword'],
                    'seo_description' => $all['seo_description'],
                ]));

                $this->createIconFile($category->getId());

                $this->dispatch(new CalculateCategoryLevel($category->getId()));

            } else {
                for ($i = 0; $i < count($isMultiCat[0]); $i++) {
                    foreach ($isMultiCat as $cat) {
                        $translatableEntries = array_merge($translatableEntries, $cat[$i]);
                    }
                    $category = $this->categoryRepository->create(array_merge($translatableEntries, [
                        'slug' => $this->str->slug(reset($translatableEntries)['name'], '_'),
                        'parent_category' => $all['parent_category'] === "" ? null : $all['parent_category'],
                        'seo_keyword' => $all['seo_keyword'],
                        'seo_description' => $all['seo_description'],
                    ]));

                    $this->createIconFile($category->getId());

                    $this->dispatch(new CalculateCategoryLevel($category->getId()));
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
        }


        return $this->view->make('visiosoft.module.cats::cats/admin-cat');
    }

    public function endsWith($string, $test)
    {
        $strlen = strlen($string);
        $testlen = strlen($test);
        if ($testlen > $strlen) return false;
        return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
    }

    public function edit(CategoryFormBuilder $form, Request $request, $id)
    {
        if ($request->action == "update") {
            $form->make($id);
            if ($form->hasFormErrors()) {
                return $this->redirect->back();
            }

            $this->createIconFile($id);

            $parent = $request->parent_category;
            if ($parent != "") {
                return $this->redirect->to('/admin/cats?cat=' . $parent);
                die;
            }
            return $this->redirect->to('/admin/cats');
        }

        return $this->view->make('visiosoft.module.cats::cats/admin-cat')->with('id', $id);
    }

    public function delete(CategoryRepositoryInterface $categoryRepository, $id)
    {
        if ($this->deleteCategory($id)) {
            $this->messages->success(trans('streams::message.delete_success', ['count' => 1]));
        }

        if (!empty($parent = $this->request->parent)) {
            if (count($categoryRepository->getCategoryById($parent))) {
                return redirect('admin/cats?cat=' . $parent);
            }
        }
        return redirect('admin/cats');
    }

    public function cleanSubCategories()
    {
        $sub_c = 1;
        for ($i = 0; $i <= $sub_c; $i++) {
            $cats = $this->categoryRepository->getDeletedCategories();
            $delete_category_keys = $cats->pluck('id')->all();
            $query_delete = $this->categoryRepository->newQuery()->whereIn('parent_category_id', $delete_category_keys);
            if ($query_delete->count()) {
                $query_delete->delete();
                $sub_c++;
            }
        }

        return redirect('admin/cats');
    }

    public function adCountCalc()
    {
        $this->dispatch(new CalculateAdsCount());

        $this->messages->success(trans('streams::message.edit_success', ['name' => trans('visiosoft.module.cats::addon.title')]));
        return redirect('admin/cats');
    }

    public function catLevelCalc()
    {
        $this->dispatch(new CalculateCategoryLevel());

        $this->messages->success(trans('streams::message.edit_success', ['name' => trans('visiosoft.module.cats::addon.title')]));
        return redirect('admin/cats');
    }

    public function createIconFile($category_id)
    {
        $folderRepository = app(FolderRepositoryInterface::class);
        $manager = app(MountManager::class);

        if ($file = $this->request->file('icon') and $folder = $folderRepository->findBySlug('category_icon') and $category = $this->categoryRepository->find($category_id)) {

            $type = explode('.', $file->getClientOriginalName());
            $type = end($type);

            $file_location = $folder->getDisk()->getSlug() . '://' . $folder->getSlug() . '/' . FileSanitizer::clean($category_id . "." . $type);

            $file_url = '/files/' . $folder->getSlug() . '/' . FileSanitizer::clean($category_id . "." . $type);

            if (Storage::exists($file_location)) {
                Storage::delete($file_location);
            }

            try {
                $manager->put($file_location, file_get_contents($file->getRealPath()));

                $category->setCategoryIconUrl($file_url);

            } catch (\Exception $exception) {
                $this->messages->error([$exception->getMessage()]);
            }

        }
    }

}
