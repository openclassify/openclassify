<?php namespace Visiosoft\ClassifiedsModule\Classified;
/**
 * Created by PhpStorm.
 * User: emek
 * Date: 13.12.2018
 * Time: 17:08
 */

use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedInterface;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Visiosoft\CatsModule\Category\Contract\CategoryInterface;
use Visiosoft\LocationModule\City\Contract\CityInterface;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;

class ClassifiedLoader {

    protected $template;

    public function __construct(ViewTemplate $template)
    {
        $this->template = $template;
    }

    public function load(ClassifiedInterface $classified, CategoryInterface $cats, CityInterface $city, CountryRepositoryInterface $country) {
        $this->template->set('classified', $classified);
        $this->template->set('country', $country->find($classified->country_id));
    }
}