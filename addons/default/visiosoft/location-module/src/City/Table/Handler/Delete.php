<?php namespace Visiosoft\LocationModule\City\Table\Handler;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;
use Visiosoft\LocationModule\City\Events\DeletedCities;


class Delete extends ActionHandler
{
    public function handle(CityRepositoryInterface $repository, array $selected)
    {
        $query = $repository->newQuery()->whereIn('location_cities.id', $selected);

        if ($count = count($cities = $query->get())) {
            $query->delete();

            event(new DeletedCities($cities));
        }

        if ($selected && $count > 0) {
            $this->messages->success(trans('streams::message.delete_success', compact('count')));
        }
    }
}