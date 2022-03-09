<?php namespace Visiosoft\ConnectModule\Http\Controller\Resource;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Anomaly\Streams\Platform\Http\Controller\ResourceController;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\Streams\Platform\Stream\StreamModel;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class StreamsController
 *

 */
class StreamsController extends ResourceController
{

    /**
     * Return a list of all streams.
     *
     * @param ResourceBuilder $resources
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ResourceBuilder $resources)
    {
        $resources->setModel(StreamModel::class);

        return $resources->response();
    }

    /**
     * Return a list of streams within a given namespace.
     *
     * @param ResourceBuilder $resources
     * @param $namespace
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function streams(ResourceBuilder $resources, $namespace)
    {
        $resources
            ->on(
                'querying',
                function (Builder $query) use ($namespace) {
                    $query->where('namespace', $namespace);
                }
            )
            ->setModel(StreamModel::class);

        return $resources->response();
    }

    /**
     * Create a new stream.
     *
     * @param StreamRepositoryInterface $streams
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StreamRepositoryInterface $streams)
    {
        return $this->response->json($streams->create($this->request->except('access_token')));
    }

    /**
     * Return a single stream.
     *
     * @param ResourceBuilder $resource
     * @param                 $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(ResourceBuilder $resource, $id)
    {
        $resource
            ->setModel(StreamModel::class)
            ->setId($id);

        return $resource->response();
    }

    /**
     * Update an existing stream.
     *
     * @param StreamRepositoryInterface $streams
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StreamRepositoryInterface $streams)
    {
        $attributes = $this->request->except('access_token');

        $stream = $streams->find($this->route->parameter('id'));

        return $this->response->json($stream->update($attributes));
    }

    /**
     * Delete an existing stream.
     *
     * @param StreamRepositoryInterface $streams
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(StreamRepositoryInterface $streams)
    {
        $stream = $streams->find($this->route->parameter('id'));

        return $this->response->json($streams->delete($stream));
    }
}
