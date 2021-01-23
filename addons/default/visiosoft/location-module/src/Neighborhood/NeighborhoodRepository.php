<?php namespace Visiosoft\LocationModule\Neighborhood;

use Anomaly\Streams\Platform\Model\Location\LocationNeighborhoodsEntryTranslationsModel;
use Visiosoft\LocationModule\Neighborhood\Contract\NeighborhoodRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class NeighborhoodRepository extends EntryRepository implements NeighborhoodRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var NeighborhoodModel
     */
    protected $model;

    /**
     * @var LocationNeighborhoodsEntryTranslationsModel
     */
    private $neighborhoodsEntryTranslationsModel;

    /**
     * Create a new NeighborhoodRepository instance.
     *
     * @param NeighborhoodModel $model
     */
    public function __construct(
        NeighborhoodModel $model,
        LocationNeighborhoodsEntryTranslationsModel $neighborhoodsEntryTranslationsModel
    )
    {
        $this->model = $model;
        $this->neighborhoodsEntryTranslationsModel = $neighborhoodsEntryTranslationsModel;
    }

    public function getByEntryIDsAndOrderByTransCol($entryIDs, $orderBy, $direction = 'asc')
    {
        return $this->neighborhoodsEntryTranslationsModel->newQuery()
            ->select('entry_id as id', 'name')
            ->whereIn('locale', [
                Request()->session()->get('_locale'),
                setting_value('streams::default_locale'),
                'en'
            ])
            ->whereIn('entry_id', $entryIDs)
            ->orderBy($orderBy, $direction)
            ->get();
    }

    public function getNeighborhoodsByDistrictId($district)
    {
        return $this->newQuery()
            ->where('parent_district_id', $district)
            ->orderBy('order', 'ASC')
            ->get();
    }
}
