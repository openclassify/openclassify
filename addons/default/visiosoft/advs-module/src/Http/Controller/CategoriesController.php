<?php namespace Visiosoft\AdvsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryModel;
use Illuminate\Support\Facades\DB;

class CategoriesController extends PublicController {

    public function listByCat($cat) {
        $advs = DB::table('advs_advs')
            ->where('category_id', $cat)
            ->leftJoin('users_users as u1', 'advs_advs.created_by_id', '=', 'u1.id')
            ->leftJoin('advs_advs_translations as t1', 'advs_advs.id', '=', 't1.id')
            ->select('advs_advs.*','u1.username as owner', 't1.name as name')
            ->get();

        return $this->view->make('visiosoft.theme.base::list/list', compact('advs'));
    }
}
