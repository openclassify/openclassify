<?php namespace Visiosoft\LocationModule\District\Table\Handler;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\LocationModule\District\Contract\DistrictRepositoryInterface;
use Visiosoft\LocationModule\District\Events\DeletedDistricts;


class Delete extends ActionHandler
{
    public function handle(DistrictRepositoryInterface $repository, array $selected)
    {
        $query = $repository->newQuery()->whereIn('location_districts.id', $selected);

        if ($count = count($cities = $query->get())) {
            $query->delete();

            event(new DeletedDistricts($cities));
        }

        if ($selected && $count > 0) {
            $this->messages->success(trans('streams::message.delete_success', compact('count')));
        }
    }
}