<?php namespace Visiosoft\CatsModule\Category;

use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends EntryRepository implements CategoryRepositoryInterface
{

    protected $model;
    protected $advRepository;

    public function __construct(CategoryModel $model, AdvRepositoryInterface $advRepository)
    {
        $this->model = $model;
        $this->advRepository = $advRepository;
    }

    public function getMainCategories()
    {
        return $this->newQuery()
            ->where('parent_category_id', null)
            ->orderBy('sort_order')
            ->get();
    }

    public function getCategoriesLevel2()
    {
        $dBName = 'default_cats_category';
        $dBNamet = $dBName . '_translations';

        $catsDB = DB::table((DB::raw($dBName . ' c1')))
            ->select(
                DB::raw('c1.id'),
                DB::raw('c1.slug'),
                DB::raw('c1.count'),
                DB::raw('c1.parent_category_id'),
                DB::raw('t1.name'),

                DB::raw('c2.id as c2_id'),
                DB::raw('c2.slug as c2_slug'),
                DB::raw('c2.count as c2_count'),
                DB::raw('c2.parent_category_id as c2_parent_category_id'),
                DB::raw('t2.name as c2_name')
            )
            ->leftJoin((DB::raw($dBName . ' c2')), DB::raw('c2.parent_category_id'), '=', DB::raw('c1.id'))
            ->leftJoin((DB::raw($dBNamet . ' t1')), DB::raw('c1.id'), '=', DB::raw('t1.entry_id'))
            ->leftJoin((DB::raw($dBNamet . ' t2')), DB::raw('c2.id'), '=', DB::raw('t2.entry_id'))
            ->where(DB::raw('t1.locale'), Request()->session()->get('_locale', setting_value('streams::default_locale')))
            ->where(DB::raw('t2.locale'), Request()->session()->get('_locale', setting_value('streams::default_locale')))
            ->where(DB::raw("c1.deleted_at"), NULL)
            ->where(DB::raw("c2.deleted_at"), NULL)
            ->whereNull(DB::raw("c1.parent_category_id"))
            ->orderBy(DB::raw("c1.sort_order"))
            ->orderBy(DB::raw("c2.sort_order"))
            ->get();
        $cats = collect([]);
        $cats->subcats = $catsDB;
        $cats->maincats = $catsDB->unique('id');
        return $cats;
    }

    public function getCategoryById($id)
    {
        return $this->newQuery()
            ->where('parent_category_id', $id)
            ->where('deleted_at', null)
            ->orderBy('sort_order')->get();
    }

    public function findBySlug($slug)
    {
        return $this->newQuery()
            ->where('slug', $slug)
            ->first();
    }

    public function getParentCategoryById($id)
    {
        if ($category = $this->find($id)) {
            $parents_count = ($category->parent_category_id) ? 1 : 0;
            $parents[] = $category;
            for ($i = 0; $i < $parents_count; $i++) {
                if ($category = $this->find($category->parent_category_id)) {
                    $parents[] = $category;
                    $parents_count++;
                }
            }

            return $parents;
        }
        return null;
    }

    public function getLevelById($id)
    {
        return count($this->getParentCategoryById($id));
    }

    public function getCategoriesByName($keyword)
    {
        $cats = DB::table('cats_category');

        $cats = $cats->where('name', 'like', $keyword . '%')
            ->whereRaw('deleted_at IS NULL');

        $cats = $cats->leftJoin('cats_category_translations', function ($join) {
            $join->on('cats_category.id', '=', 'cats_category_translations.entry_id');
            $join->whereIn('cats_category_translations.locale', [config('app.locale'), setting_value('streams::default_locale'), 'en']);//active lang
        })
            ->select('cats_category.*', 'cats_category_translations.name as name')
            ->orderBy('id', 'DESC')->groupBy(['cats_category.id'])->get();

        return $cats;
    }
}