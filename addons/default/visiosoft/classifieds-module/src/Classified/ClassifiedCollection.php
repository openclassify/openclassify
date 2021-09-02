<?php namespace Visiosoft\ClassifiedsModule\Classified;

use Anomaly\Streams\Platform\Entry\EntryCollection;
use Carbon\Carbon;
use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ClassifiedCollection extends EntryCollection
{
    public function paginate($pageSize = null)
    {
        $pageSize = $pageSize ?: setting_value('streams::per_page');
        $page = Paginator::resolveCurrentPage('page');

        $total = $this->count();

        return self::paginator($this->forPage($page, $pageSize), $total, $pageSize, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }

    protected static function paginator($items, $total, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
            'items', 'total', 'perPage', 'currentPage', 'options'
        ));
    }

    public function nonExpired()
    {
        return $this->filter(
            function ($classified) {
	            return $classified->where('finish_at', '>', Carbon::now());
            }
        );
    }
}
