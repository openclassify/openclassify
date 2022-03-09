<?php namespace Visiosoft\LocationModule\Neighborhood\Table\Handler;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\LocationModule\Neighborhood\Contract\NeighborhoodRepositoryInterface;
use Visiosoft\LocationModule\Neighborhood\Events\DeletedNeighborhoods;


class Delete extends ActionHandler
{
    public function handle(NeighborhoodRepositoryInterface $repository, array $selected)
    {
        $query = $repository->newQuery()->whereIn('location_neighborhoods.id', $selected);

        if ($count = count($cities = $query->get())) {
            $query->delete();

            event(new DeletedNeighborhoods($cities));
        }

        if ($selected && $count > 0) {
            $this->messages->success(trans('streams::message.delete_success', compact('count')));
        }
    }
}