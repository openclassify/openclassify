<?php namespace Visiosoft\LocationModule\Village;

use Anomaly\Streams\Platform\Model\Location\LocationVillageEntryTranslationsModel;
use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class VillageRepository extends EntryRepository implements VillageRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var VillageModel
     */
    protected $model;

    /**
     * @var LocationVillageEntryTranslationsModel
     */
    private $villageEntryTranslationsModel;

    /**
     * Create a new VillageRepository instance.
     *
     * @param VillageModel $model
     */
    public function __construct(
        VillageModel $model,
        LocationVillageEntryTranslationsModel $villageEntryTranslationsModel
    )
    {
        $this->model = $model;
        $this->villageEntryTranslationsModel = $villageEntryTranslationsModel;
    }

    public function getByEntryIDsAndOrderByTransCol($entryIDs, $orderBy, $direction = 'asc')
    {
        return $this->villageEntryTranslationsModel->newQuery()
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

    public function getVillagesByNeighborhoodId($neighborhood)
    {
        return $this->newQuery()->where('parent_neighborhood_id', $neighborhood)->orderBy('order','ASC')->get();
    }
}
