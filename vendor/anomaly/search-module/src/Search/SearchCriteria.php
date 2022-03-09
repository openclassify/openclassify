<?php namespace Anomaly\SearchModule\Search;

use Anomaly\Streams\Platform\Entry\EntryCriteria;
use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Stream\Command\GetStream;

/**
 * Class SearchCriteria
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SearchCriteria extends EntryCriteria
{

    /**
     * Search in provided streams.
     *
     * @param $streams
     * @return $this
     */
    public function in($streams)
    {
        $streams = new EloquentCollection(
            array_filter(
                array_map(
                    function ($stream) {
                        try {
                            return dispatch_now(new GetStream($stream));
                        } catch (\Exception $exception) {
                            return null;
                        }
                    },
                    (array)$streams
                )
            )
        );

        if ($streams->isEmpty()) {
            return $this;
        }

        $this->query->whereIn('stream_id', $streams->ids());

        return $this;
    }

}
