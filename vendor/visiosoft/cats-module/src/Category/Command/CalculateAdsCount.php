<?php namespace Visiosoft\CatsModule\Category\Command;

use DateTime;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;

class CalculateAdsCount
{
    use DispatchesJobs;

    protected $category_id;

    public function __construct($category_id = null)
    {
        $this->category_id = $category_id;
    }

    public function handle()
    {
        $date = new DateTime;
        $date->modify('-30 minutes');
        $formatted_date = $date->format('Y-m-d H:i:s');

        $query = DB::table('cats_category')
            ->select('id', 'level');

        if ($this->category_id and $category = $query->where('id', $this->category_id)->first()) {
            $this->calculateCategory($category->id, $category->level);
        } else {
            $result = $query->where('count_at', '<', $formatted_date)
                ->orWhereNull('count_at')->get();

            foreach ($result as $key => $category) {
                $this->calculateCategory($category->id, $category->level);
            }
        }
    }

    public function calculateCategory($category_id, $level)
    {
        $advRepository = app(AdvRepositoryInterface::class);
        if (!empty($level)) {
            $count = $advRepository->getAdsCountByCategory($category_id, $level);
            DB::table('cats_category')->where('id', $category_id)->update(array(
                'count' => $count,
                'count_at' => now(),
            ));
        } else {
            $this->dispatch(new CalculateCategoryLevel($category_id));
        }
    }
}
