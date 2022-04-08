<?php namespace Anomaly\BooleanFieldType\Http\Controller\Admin;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Contracts\Container\Container;

/**
 * Class BooleanController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BooleanController extends AdminController
{

    /**
     * Toggle the boolean value.
     *
     * @param  StreamRepositoryInterface $streams
     * @param  Container                 $container
     * @throws \Exception
     */
    public function toggle(StreamRepositoryInterface $streams, Container $container)
    {

        /*
         * First fine the stream by
         * it's slug and namespace.
         */
        if (!$stream = $streams->findBySlugAndNamespace(
            $slug = $this->request->get('stream'),
            $namespace = $this->request->get('namespace')
        )
        ) {
            throw new \Exception("Stream not found with slug [{$slug}] in namespace [{$namespace}].");
        }

        /*
         * Grab the model from the stream.
         */
        $model = $stream->getEntryModel();

        /* @var EntryRepositoryInterface $repository */
        $repository = $container->make(EntryRepositoryInterface::class);

        /*
         * Set the model manually since
         * it's a generic repository.
         */
        $repository->setModel($model);

        /*
         * Try finding the entry with
         * our generic repository.
         */
        if (!$entry = $repository->find($id = $this->request->get('entry'))) {
            throw new \Exception("Entry [{$id}] not found in stream [{$slug}] in namespace [{$namespace}].");
        }

        /*
         * Make the request change to the entry
         * based on the state submitted.
         */
        $entry->{$this->request->get('field')} = $this->request->get('checked');

        /*
         * Save and don't return a thing.
         */
        $repository->save($entry);

        return $this->response->json(
            [
                'errors' => [],
            ]
        );
    }
}
