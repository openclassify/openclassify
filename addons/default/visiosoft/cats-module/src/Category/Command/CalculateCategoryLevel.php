<?php namespace Visiosoft\CatsModule\Category\Command;

use DateTime;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class CalculateCategoryLevel
{
    use DispatchesJobs;

    protected $category_id;

    public function __construct($category_id = null)
    {
        $this->category_id = $category_id;
    }

    public function handle()
    {
        if ($this->category_id) {
            $this->calculateLevelByCategory($this->category_id);
        } else {
            $date = new DateTime;
            $date->modify('-30 minutes');
            $formatted_date = $date->format('Y-m-d H:i:s');

            $result = DB::table('cats_category')
                ->select('id')
                ->where('level_at', '<', $formatted_date)
                ->where('level', '=', 0)
                ->orWhereNull('level_at')
                ->get();

            foreach ($result as $key => $category) {
                $this->calculateLevelByCategory($category->id);
            }
        }
    }

    public function calculateLevelByCategory($category_id)
    {
        $categoryRepository = app(CategoryRepositoryInterface::class);

        $level = $categoryRepository->getLevelById($category_id);

        if($level)
        {
            DB::table('cats_category')->where('id', $category_id)
                ->update(array(
                    'level' => $level,
                    'level_at' => now(),
                ));
        }
    }
}
