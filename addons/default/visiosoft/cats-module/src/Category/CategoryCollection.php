<?php namespace Visiosoft\CatsModule\Category;

use Anomaly\Streams\Platform\Entry\EntryCollection;
use Carbon\Carbon;

class CategoryCollection extends EntryCollection
{
    public function deleteCat($id)
    {
        $adv = CategoryModel::query()->find($id);
        $adv->deleted_at = Carbon::now();
        $adv->save();
    }

    public function subCatDelete($id)
    {
        $counter = 0;

        for ($i = 0; $i <= $counter; $i++) {
            $data = CategoryModel::query()
                ->where('parent_category_id', $id)
                ->where('deleted_at', null)
                ->select('cats_category.id', 'cats_category.parent_category_id')
                ->first();
            if ($data != "") {
                $id = $data['id'];
                $counter++;
            }
        }
        $delete = new CategoryCollection();
        $delete = $delete->deleteCat($id);
    }
}
