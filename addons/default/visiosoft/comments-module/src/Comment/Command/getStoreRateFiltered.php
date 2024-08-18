<?php namespace Visiosoft\CommentsModule\Comment\Command;

use Illuminate\Support\Facades\DB;
use Visiosoft\CommentsModule\Comment\Contract\CommentRepositoryInterface;

class getStoreRateFiltered
{
    protected $query;
    protected $rate;

    public function __construct($query, $rate)
    {
        $this->query = $query;
        $this->rate = $rate;
    }

    public function handle(CommentRepositoryInterface $repository)
    {
        $star = [
            1 => [0, 20],
            2 => [20, 40],
            3 => [40, 60],
            4 => [60, 80],
            5 => [80, 100]
        ];

        $rates = $this->rate;

        $stores = $repository->newQuery()
            ->where('entry_type', 'Visiosoft\StoreModule\Store\StoreModel')
            ->groupBy('entry_id')
            ->select('entry_id', DB::raw('AVG(rating) as rate'))
            ->havingRaw('rate >= ? and rate <= ?', [$star[$rates]])
            ->pluck('entry_id');

        return $this->query->whereIn('store_store.id', $stores);
    }
}
