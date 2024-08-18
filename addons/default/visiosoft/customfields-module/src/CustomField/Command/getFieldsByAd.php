<?php namespace Visiosoft\CustomfieldsModule\CustomField\Command;

use Anomaly\Streams\Platform\Support\Collection;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\CustomfieldsModule\CustomField\Contract\CustomFieldRepositoryInterface;

class getFieldsByAd
{
    private $ad_id;

    public function __construct($ad_id)
    {
        $this->ad_id = $ad_id;
    }

    public function handle(AdvModel $ad_model, CustomFieldRepositoryInterface $customFieldRepository)
    {
        if ($ad = $ad_model->newQuery()->find($this->ad_id)) {


            $collection = new Collection();

            $findcustomfields = $customFieldRepository->getCustomfieldsJoinCategoryWithCategoryID();

            $collection = $this->getCustomFields($findcustomfields, $collection);


            $categories = array_filter($ad->toArray(), function ($key) {
                return ((strpos($key, 'cat') === 0) and is_numeric(substr($key, '3')));
            }, ARRAY_FILTER_USE_KEY);

            foreach ($categories as $category) {

                if ($category) {
                    $findcustomfields = $customFieldRepository->getCustomfieldsJoinCategoryWithCategoryID($category);

                    $collection = $this->getCustomFields($findcustomfields, $collection);
                }

            }

            return $collection;

        }

        return null;
    }

    public function isCFAdded($collection, $slug)
    {
        $is_added = $collection->filter(
            function ($item) use ($slug) {
                return $item->slug == $slug;
            }
        );

        return count($is_added) > 0;

    }

    public function getCustomFields($findcustomfields, $collection)
    {
        foreach ($findcustomfields as $findcustomfield) {
            $values = null;

            if ($findcustomfield->cfvalues()->count() > 0) {
                $values = array();

                foreach ($findcustomfield->cfvalues as $v) {
                    $key = $findcustomfield->type == 'selectrange' ? $v->custom_field_value : $v->id;
                    $values[$key] = $v->custom_field_value;
                }

                $findcustomfield->options = $values;
            }


            if (!$this->isCFAdded($collection, $findcustomfield->slug)) {
                $collection->add($findcustomfield);
            }
        }

        return $collection;
    }
}
