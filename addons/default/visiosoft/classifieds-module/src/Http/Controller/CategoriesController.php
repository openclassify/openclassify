<?php namespace Visiosoft\ClassifiedsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Support\Facades\DB;

class CategoriesController extends PublicController
{
    public function listByCat($cat)
    {
        $classifieds = DB::table('classifieds_classifieds')
            ->where('cat1', $cat)
            ->orwhere('cat2', $cat)
            ->orwhere('cat3', $cat)
            ->orwhere('cat4', $cat)
            ->orwhere('cat5', $cat)
            ->orwhere('cat6', $cat)
            ->orwhere('cat7', $cat)
            ->leftJoin('users_users as u1', 'classifieds_classifieds.created_by_id', '=', 'u1.id')
            ->leftJoin('classifieds_classifieds_translations as t1', 'classifieds_classifieds.id', '=', 't1.id')
            ->select('classifieds_classifieds.*','u1.username as owner', 't1.name as name')
            ->get();

        foreach ($classifieds as $classified) {
            if (strpos($classified->cover_photo, 'http') !== 0 && strpos($classified->cover_photo, '/') !== 0) {
                $classified->cover_photo = "/$classified->cover_photo";
            }
        }

        return $this->view->make('visiosoft.module.classifieds::list/list', compact('classifieds'));
    }
}
