<?php namespace Visiosoft\CatsModule\Category;

use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryModel;
use Illuminate\Support\Facades\DB;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class CategoryRepository extends EntryRepository implements CategoryRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var CategoryModel
     */
    protected $model;
    protected $advRepository;

    /**
     * Create a new CategoryRepository instance.
     *
     * @param CategoryModel $model
     * @param AdvRepositoryInterface $advRepository
     */
    public function __construct(CategoryModel $model, AdvRepositoryInterface $advRepository)
    {
        $this->model = $model;
        $this->advRepository = $advRepository;
    }

    public function findById($id)
    {
        return $this->model->orderBy('created_at', 'DESC')->where('cats_category.id', $id)->first();
    }

    public function mainCats()
    {
        return $this->model->where('parent_category_id', null)->orderBy('sort_order')->get();
    }

    public function getItem($cat)
    {
        return $this->model->where('cats_category.id', $cat)->first();
    }

    public function getCatById($id)
    {
        return $this->model->where('cats_category.id', $id)->where('deleted_at', null)->orderBy('sort_order')->get();
    }

    public function getSubCatById($id)
    {
        $cats = $this->model->newQuery()
            ->where('parent_category_id', $id)
            ->get();

        foreach ($cats as $cat) {
            $subCount = $this->model->newQuery()->where('parent_category_id', $cat->id)->count();
            $cat->hasChild = !!$subCount;
        }

        return $cats;
    }

    public function getSingleCat($id)
    {
        return CatsCategoryEntryModel::query()->where('cats_category.id', $id)->first();
    }

    public function findBySlug($slug)
    {
        return $this->model->orderBy('created_at', 'DESC')->where('slug', $slug)->first();
    }

    public function getCategories()
    {
        return $this->model->orderBy('sort_order')->get();
    }

    public function removeCatFromAds($category)
    {
        $catLevelNum = 1;
        if (!is_null($category->parent_category_id)) {
            $catLevelNum = $this->model->getCatLevel($category->id);
        }
        $catLevelText = "cat" . $catLevelNum;

        $advs = $this->advRepository->newQuery()->where($catLevelText, $category->id)->get();
        foreach ($advs as $adv) {
            $nullableCats = array();
            for ($i = $catLevelNum; $i <= 10; $i++) {
                $nullableCats['cat' . $i] = null;
            }
            $adv->update($nullableCats);
        }
    }

    public function DeleteCategories($id)
    {
        if (!is_null($category = $this->find($id))) {
            // Remove deleted category from ads
            $this->removeCatFromAds($category);

            // Delete the category
            $this->model->find($id)->delete();

            // Delete the subcategories
            $this->model->deleteSubCategories($id);
        }
    }

	public function getMainAndSubCats()
	{
		$dBName = 'cats_category';
		$dBNamet = $dBName . '_translations';

		$catsDB = DB::table($dBName . ' as c1')
			->select(
				'c1.id',
				'c1.slug',
				'c1.parent_category_id',
				'c1.icon_id',
				't1.name',
				'c2.id as c2_id',
				'c2.slug as c2_slug',
				'c2.parent_category_id as c2_parent_category_id',
				't2.name as c2_name',
				'file.id as file_id'
			)
			->leftJoin($dBName . ' as c2', function ($join) {
			    $join->on('c2.parent_category_id', '=', 'c1.id')
                    ->whereNull('c2.deleted_at');
            })
			->leftJoin($dBNamet . ' as t1', function ($join) use ($dBNamet) {
			    $join->on('c1.id', '=', 't1.entry_id')
                    ->where('t1.locale', Request()->session()->get('_locale', setting_value('streams::default_locale')));
            })
			->leftJoin($dBNamet . ' as t2', function ($join) use ($dBNamet) {
			    $join->on('c2.id', '=', 't2.entry_id')
                    ->where('t2.locale', Request()->session()->get('_locale', setting_value('streams::default_locale')));
            })
			->leftJoin('files_files as file', 'c1.icon_id', 'file.id')
			->whereNull('c1.deleted_at')
			->whereNull('c1.parent_category_id')
			->orderBy('c1.sort_order')
			->orderBy('c2.sort_order')
			->get();
		$cats = collect([]);
		$cats->subcats = $catsDB;
		$cats->maincats = $catsDB->unique('id');
		return $cats;
	}
}
