<?php namespace Visiosoft\CommentsModule\Comment;

use Visiosoft\CommentsModule\Comment\Contract\CommentRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class CommentRepository extends EntryRepository implements CommentRepositoryInterface
{
    protected $model;

    public function __construct(CommentModel $model)
    {
        $this->model = $model;
    }

    public function getRating($entry_type, $entry_id)
    {
        $rating = $this->newQuery()
            ->where('entry_type', $entry_type)
            ->where('entry_id', $entry_id)
	        ->where('status', 1)
            ->get();

        if (count($rating))
        {
            $total = $rating->sum('rating');
            $count = $rating->count();
            $rating = $total / $count;
        } else {
            $rating = 0;
        }
        return [
        	'rating' => $rating,
	        'count' => $count ?? 0,
        ];
    }

    public function getProductsRateReport()
    {
        $comments = $this->newQuery()
            ->selectRaw('ROUND(AVG(rating)) as rate, name')
            ->where('entry_type', 'Visiosoft\AdvsModule\Adv\AdvModel')
            ->groupBy('comments_comments.entry_id')
            ->leftJoin('advs_advs_translations as classified_trans', function ($join) {
                $join->on('comments_comments.entry_id', '=', 'classified_trans.entry_id');
                $join->whereIn('locale', [config('app.locale'), setting_value('streams::default_locale'), 'en']);
            });

        if ($search = request('search.value')) {
            $comments = $comments->where('name', 'LIKE', "%$search%");
        }

        if ($orderDir = request('order.0.dir')) {
            $comments = $comments->orderBy(request('order.0.column') == 1 ? 'rate' : 'name', $orderDir);
        }

        $start = request('start');
        $limit = request('length') ?: 10;
        $page = $start ? $start / $limit + 1 : 1;

        return $comments->paginate($limit, ['*'], 'page', $page);
    }

    public function getProductsCommentsReport()
    {
        $comments = $this->newQuery()
            ->selectRaw('COUNT(*) as count, name')
            ->where('entry_type', 'Visiosoft\AdvsModule\Adv\AdvModel')
            ->groupBy('comments_comments.entry_id')
            ->leftJoin('advs_advs_translations as classified_trans', function ($join) {
                $join->on('comments_comments.entry_id', '=', 'classified_trans.entry_id');
                $join->whereIn('locale', [config('app.locale'), setting_value('streams::default_locale'), 'en']);
            });

        if ($search = request('search.value')) {
            $comments = $comments->where('name', 'LIKE', "%$search%");
        }

        if ($orderDir = request('order.0.dir')) {
            $comments = $comments->orderBy(request('order.0.column') == 1 ? 'count' : 'name', $orderDir);
        }

        $start = request('start');
        $limit = request('length') ?: 10;
        $page = $start ? $start / $limit + 1 : 1;

        return $comments->paginate($limit, ['*'], 'page', $page);
    }
}
