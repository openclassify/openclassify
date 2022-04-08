<?php namespace Visiosoft\ConnectModule\Http\Controller\Resource;

use Anomaly\PostsModule\Category\Contract\CategoryRepositoryInterface;

use Visiosoft\ConnectModule\Command\GetRepository;
use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Anomaly\Streams\Platform\Http\Controller\ResourceController;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

/**
 * Class EntriesController
 *
 * @package       Visiosoft\ConnectModule\Http\Resource
 */
class EntriesController extends ResourceController
{

    /**
     * Return a list of stream entries.
     *
     * @param ResourceBuilder $resources
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ResourceBuilder $resources)
    {
        return $resources->response(
            $this->route->parameter('namespace'),
            $this->route->parameter('stream')
        );
    }

    /**
     * Create a new entry.
     *
     * @param StreamRepositoryInterface $streams
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StreamRepositoryInterface $streams)
    {
        $attributes = $this->request->except('access_token');


        $stream = $streams->findBySlugAndNamespace(
            $this->route->parameter('stream'),
            $this->route->parameter('namespace')
        );

        $repository = $this->dispatch(new GetRepository($stream->getEntryModelName()));

        $search_type = $this->getOption('search_type');
        $search_function = $this->getOption('search_function');
        $search_parameters = $this->getOption('search_parameters');

        if ($search_function) {

            try {
                switch ($search_type) {

                    case "model":
                        $entry = call_user_func_array([$stream->getEntryModel(), camel_case($search_function)], $search_parameters);
                        break;

                    default:
                        $entry = call_user_func_array([$repository, camel_case($search_function)], $search_parameters);

                }

                return $this->response->json(['status' => ($entry) ? true : false]);

            } catch (\Exception $exception) {
                return $this->response->json(['status' => false, 'message' => $exception->getMessage()],400);
            }
            die;
        }

        return $this->response->json($repository->create($attributes));
    }

    /**
     * Return a single stream entry.
     *
     * @param ResourceBuilder $resource
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(ResourceBuilder $resource)
    {
        return $resource
            ->setId($this->route->parameter('id'))
            ->setOption('map', $this->route->parameter('map'))
            ->setOption('read', true)
            ->response(
                $this->route->parameter('namespace'),
                $this->route->parameter('stream')
            );
    }

    /**
     * Update an existing entry.
     *
     * @param StreamRepositoryInterface $streams
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StreamRepositoryInterface $streams)
    {
        $attributes = $this->request->except('access_token');

        $stream = $streams->findBySlugAndNamespace(
            $this->route->parameter('stream'),
            $this->route->parameter('namespace')
        );

        $repository = (new EntryRepository())->setModel($stream->getEntryModel());

        $entry = $repository->find($this->route->parameter('id'));

        return $this->response->json($entry->update($attributes));
    }

    /**
     * Delete an existing entry.
     *
     * @param StreamRepositoryInterface $streams
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(StreamRepositoryInterface $streams)
    {
        $stream = $streams->findBySlugAndNamespace(
            $this->route->parameter('stream'),
            $this->route->parameter('namespace')
        );

        $repository = (new EntryRepository())->setModel($stream->getEntryModel());

        $entry = $repository->find($this->route->parameter('id'));

        return $this->response->json($repository->delete($entry));
    }

    public function getRequestOptions()
    {
        return $this->request->get('options', []);
    }

    public function getOption($key, $default = null)
    {
        if (array_key_exists($key, $this->getRequestOptions())) {
            return $this->getRequestOptions()[$key];
        }

        return value($default);
    }
}
