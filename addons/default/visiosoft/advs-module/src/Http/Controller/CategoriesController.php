<?php namespace Visiosoft\AdvsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Support\Facades\DB;

class CategoriesController extends PublicController
{
    public function listByCat($cat)
    {
        $advs = DB::table('advs_advs')
            ->where('cat1', $cat)
            ->orwhere('cat2', $cat)
            ->orwhere('cat3', $cat)
            ->orwhere('cat4', $cat)
            ->orwhere('cat5', $cat)
            ->orwhere('cat6', $cat)
            ->orwhere('cat7', $cat)
            ->leftJoin('users_users as u1', 'advs_advs.created_by_id', '=', 'u1.id')
            ->leftJoin('advs_advs_translations as t1', 'advs_advs.id', '=', 't1.id')
            ->select('advs_advs.*','u1.username as owner', 't1.name as name')
            ->get();

        foreach ($advs as $adv) {
            if (strpos($adv->cover_photo, 'http') !== 0 && strpos($adv->cover_photo, '/') !== 0) {
                $adv->cover_photo = "/$adv->cover_photo";
            }
        }

        return $this->view->make('visiosoft.module.advs::list/list', compact('advs'));
    }
}
