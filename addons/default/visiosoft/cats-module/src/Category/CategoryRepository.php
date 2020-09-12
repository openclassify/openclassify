<?php namespace Visiosoft\CatsModule\Category;

use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Visiosoft\CatsModule\Category\Events\DeletedCategory;

class CategoryRepository extends EntryRepository implements CategoryRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var CategoryModel
     */
    protected $model;

    /**
     * Create a new CategoryRepository instance.
     *
     * @param CategoryModel $model
     * @param AdvRepositoryInterface $advRepository
     */
    public function __construct(CategoryModel $model)
    {
        $this->model = $model;
    }

    public function deleteSubCategories($id)
    {
        $sub = $this->getSubCategories($id);
        for ($i = 0; $i <= count($sub) - 1; $i++) {
            $sub = array_merge($sub, $this->getSubCategories($sub[$i]));
        }

        if (count($sub)) {
            $this->newQuery()->whereIn('id', $sub)->delete();
        }
        return true;
    }

    public function deleteCategories($id)
    {
        if ($category = $this->find($id)) {
            $category->delete();

            event(new DeletedCategory($category, $this->getParents($id)));

            $this->deleteSubCategories($id);
        }
    }

    public function skipAndTake($take, $skip)
    {
        $this->newQuery()
            ->skip($take * $skip)
            ->take($take)
            ->get();
    }

    public function getParents($id)
    {
        $category = $this->find($id);
        $z = 1;
        $categories = [$category];

        for ($i = 0; $i < $z; $i++) {
            if ($category = $this->find($category->parent_category_id)) {
                $categories[] = $category;
                if (!$category->parent_category_id) {
                    break;
                }
                $z++;
            }
        }
        return $categories;
    }

    public function getSubCategories($id)
    {
        $cats = $this->newQuery()
            ->where('parent_category_id', $id)
            ->get();

        foreach ($cats as $cat) {
            $subCount = $this->model->newQuery()->where('parent_category_id', $cat->id)->count();
            $cat->hasChild = !!$subCount;
        }
        return $cats;
    }

    public function getMainCategories()
    {
        return $this->newQuery()->whereNull('parent_category_id')->get();
    }

    public function getCategoryTextSeo($categories)
    {
        if (count($categories) == 1 || count($categories) == 2) {
            $catText = end($mainCats)['name'];
        } elseif (count($categories) > 2) {
            $catArray = array_slice($categories->toArray(), 2);
            $catText = '';
            $loop = 0;
            foreach ($catArray as $cat) {
                $catText = !$loop ? $catText . $cat['name'] : $catText . ' ' . $cat['name'];
                $loop++;
            }
        }
    }

    public function setQuerySearchingAds($query, $category)
    {
        $catLevel = "cat" . (!$category->parent_category_id) ? 1 : count($this->getParents($category->id));

        return $query->where($catLevel, $category->id);
    }

    public function searchKeyword($keyword, $selected = null)
    {
        $data = [];
        $cats = $this->newQuery();

        if ($selected) {
            if (strpos($selected, "-") !== false) {
                $cats = $cats->whereNotIn('id', explode('-', $selected));
            } else {
                $cats = $cats->where('id', '!=', $selected);
            }
        }

        $cats = $cats->where('name', 'like', $keyword . '%')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($cats as $cat) {
            $link = '';
            $parents = $this->getParents($cat->id);
            krsort($parents);
            foreach ($parents as $key => $parent) {
                $link .= ($key == 0) ? $parent->name . '' : $parent->name . ' > ';
            }

            $data[] = array(
                'id' => $cat->id,
                'name' => $cat->name,
                'parents' => $link
            );
        }
        return $data;
    }
}
