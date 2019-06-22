<?php namespace Visiosoft\AdvsModule\Adv;
/**
 * Created by PhpStorm.
 * User: emek
 * Date: 13.12.2018
 * Time: 17:08
 */

use Visiosoft\AdvsModule\Adv\Contract\AdvInterface;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Visiosoft\CatsModule\Category\Contract\CategoryInterface;
use Visiosoft\LocationModule\City\Contract\CityInterface;
use Visiosoft\LocationModule\Country\Contract\CountryInterface;

class AdvLoader {

    protected $template;

    public function __construct(ViewTemplate $template)
    {
        $this->template = $template;
    }

    public function load(AdvInterface $adv, CategoryInterface $cats, CityInterface $city, CountryInterface $country) {
        $this->template->set('adv', $adv);
        $this->template->set('country', $country->getCountry($adv->country_id));
    }
}