<?php namespace Visiosoft\CatsModule\Http\Controller\Admin;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\FileUploader;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryTranslationsModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Flysystem\MountManager;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\CatsModule\Category\CategoryExport;
use Visiosoft\CatsModule\Category\CategoryImport;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\CatsModule\Category\Command\CalculateAdsCount;
use Visiosoft\CatsModule\Category\Command\CalculateCategoryLevel;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\Form\CategoryFormBuilder;
use Visiosoft\CatsModule\Category\Table\CategoryTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\CatsModule\Category\Traits\DeleteCategory;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends AdminController
{
    private $categoryRepository;
    private $categoryEntryTranslationsModel;
    private $str;
    private $advRepository;

    use DeleteCategory;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        CatsCategoryEntryTranslationsModel $categoryEntryTranslationsModel,
        Str $str,
        AdvRepositoryInterface $advRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryEntryTranslationsModel = $categoryEntryTranslationsModel;
        $this->str = $str;
        $this->advRepository = $advRepository;
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
            $this->messages->error(trans('visiosoft.module.cats::message.cat_no_sub'));
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
                $this->messages->error(trans('visiosoft.module.cats::message.sub_limit'));

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
                $slug = $all['slug'];
                if (!$this->categoryRepository->findBySlug($slug)) {
                    $category = $this->categoryRepository->create(array_merge($translatableEntries, [
                        'slug' => $all['slug'],
                        'parent_category' => $all['parent_category'] === "" ? null : $all['parent_category'],
                        'seo_keyword' => $all['seo_keyword'],
                        'seo_description' => $all['seo_description'],
                    ]));

                    $this->createIconFile($category->getId());

                    $this->dispatch(new CalculateCategoryLevel($category->getId()));
                } else {
                    $this->messages->error(trans('visiosoft.module.cats::message.cat_slug_exists', [
                        'slug' => $slug
                    ]));
                }
            } else {
                for ($i = 0; $i < count($isMultiCat[0]); $i++) {
                    foreach ($isMultiCat as $cat) {
                        $translatableEntries = array_merge($translatableEntries, $cat[$i]);
                    }

                    $slug = $this->str->slug(
                        collect($translatableEntries)->where('name', '!=', '')->first()['name'],
                        '_'
                    );
                    if ($this->categoryRepository->findBySlug($slug)) {
                        $this->messages->error(trans('visiosoft.module.cats::message.cat_slug_exists', [
                            'slug' => $slug
                        ]));

                        continue;
                    }
                    $category = $this->categoryRepository->create(array_merge($translatableEntries, [
                        'slug' => $slug,
                        'parent_category' => $all['parent_category'] === "" ? null : $all['parent_category'],
                        'seo_keyword' => $all['seo_keyword'],
                        'seo_description' => $all['seo_description'],
                        'seo_title' => $all['seo_title']
                    ]));

                    $this->createIconFile($category->getId());

                    $this->dispatch(new CalculateCategoryLevel($category->getId()));
                }
            };

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
                $query_delete->limit(100)->delete();
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
        if ($request_file = $this->request->file('icon')) {
            try {
                $this->categoryRepository->setCategoryIcon($category_id, $request_file);
            } catch (\Exception $exception) {
                $this->messages->error($exception->getMessage());
            }
        }
    }

    public function import(FormBuilder $builder, FileRepositoryInterface $fileRepository)
    {

        if (request()->action == "save" and $file = $fileRepository->find(request()->file)) {
            if ($file->extension === 'xls' || $file->extension === 'xlsx') {
                $pathToFolder = "/storage/streams/" . app(Application::class)->getReference() . "/files-module/local/ads_excel/";
                Excel::import(new CategoryImport(), base_path() . $pathToFolder . $file->name);
                $this->messages->success(trans('streams::message.create_success', ['name' => trans('module::addon.title')]));
            }
        }

        //Form Render
        $builder->setFields([
            'file' => [
                "type" => "anomaly.field_type.file",
                "config" => [
                    'folders' => ["ads_excel"],
                    'mode' => 'upload'
                ]
            ],
        ]);
        $builder->setActions([
            'save'
        ]);

        $builder->setOptions([
            'redirect' => route('visiosoft.module.cats::admin_cats')
        ]);

        return $builder->render();
    }

    public function export()
    {
        return Excel::download(new CategoryExport(), 'cats-' . time() . '.xlsx');
    }

    public function all()
    {
        try {
            if ($this->categoryRepository->count() > 100) {
                throw new \Exception('more_than_100');
            }

            return [
                'success' => true,
                'data' => $this->categoryRepository->all(),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'msg' => $e->getMessage(),
            ];
        }
    }

    public function convertMain($id)
    {
        if ($category = $this->categoryRepository->find($id)) {
             $category->update(['parent_category_id' => null,'level' => 1]);

             $this->advRepository
                 ->newQuery()
                 ->where('cat'.$category->level, $id)
                 ->update([
                     'cat1' => DB::raw('cat2'),
                     'cat2' => DB::raw('cat3'),
                     'cat3' => DB::raw('cat4'),
                     'cat4' => DB::raw('cat5'),
                     'cat5' => DB::raw('cat6'),
                     'cat6' => DB::raw('cat7'),
                     'cat7' => DB::raw('cat8'),
                     'cat8' => DB::raw('cat9'),
                     'cat9' => DB::raw('cat10'),
                     'cat10' => null
                 ]);
             $this->messages->success(trans('streams::message.edit_success', ['name' => trans('visiosoft.module.cats::addon.title')]));
        }

        return redirect('admin/cats');

    }
}
