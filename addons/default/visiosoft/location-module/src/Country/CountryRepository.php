<?php namespace Visiosoft\LocationModule\Country;

use Anomaly\Streams\Platform\Model\Location\LocationCountriesEntryTranslationsModel;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class CountryRepository extends EntryRepository implements CountryRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var CountryModel
     */
    protected $model;

    /**
     * @var LocationCountriesEntryTranslationsModel
     */
    private $countriesEntryTranslationsModel;

    /**
     * Create a new CountryRepository instance.
     *
     * @param CountryModel $model
     */
    public function __construct(
        CountryModel $model,
        LocationCountriesEntryTranslationsModel $countriesEntryTranslationsModel
    )
    {
        $this->model = $model;
        $this->countriesEntryTranslationsModel = $countriesEntryTranslationsModel;
    }

    public function getByEntryIDsAndOrderByTransCol($entryIDs, $orderBy, $direction = 'asc')
    {
        return $this->countriesEntryTranslationsModel->newQuery()
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
}
