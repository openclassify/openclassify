<?php namespace Anomaly\Streams\Platform\Http\Controller;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\Streams\Platform\Support\Authorizer;

/**
 * Class EntryController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EntryController extends AdminController
{

    /**
     * The addon collection.
     *
     * @var AddonCollection
     */
    protected $addons;

    /**
     * The stream repository.
     *
     * @var StreamRepositoryInterface
     */
    protected $streams;

    /**
     * The authorizer service.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * The entry repository.
     *
     * @var EntryRepositoryInterface
     */
    protected $repository;

    /**
     * Create a new EntryController instance.
     *
     * @param AddonCollection           $addons
     * @param Authorizer                $authorizer
     * @param StreamRepositoryInterface $streams
     * @param EntryRepositoryInterface  $repository
     */
    public function __construct(
        AddonCollection $addons,
        Authorizer $authorizer,
        StreamRepositoryInterface $streams,
        EntryRepositoryInterface $repository
    ) {
        parent::__construct();

        $this->addons     = $addons;
        $this->streams    = $streams;
        $this->authorizer = $authorizer;
        $this->repository = $repository;
    }

    /**
     * Restore an entry.
     *
     * @param $addon
     * @param $namespace
     * @param $stream
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($addon, $namespace, $stream, $id)
    {
        $addon = $this->addons->get($addon);

        /* @var StreamInterface $stream */
        $stream = $this->streams->findBySlugAndNamespace($stream, $namespace);

        /*
         * Resolve the model and set
         * it on the repository.
         */
        $this->repository->setModel($this->container->make($stream->getEntryModelName()));

        $entry = $this->repository->findTrashed($id);

        if (!$this->authorizer->authorize($addon->getNamespace($stream->getSlug() . '.write'))) {
            abort(403);
        }

        if (!$entry->isRestorable()) {
            $this->messages->error('streams::message.restore_failed');

            return $this->redirect->back();
        }

        $this->repository->restore($entry);

        $this->messages->success('streams::message.restore_success');

        return $this->redirect->back();
    }

    /**
     * Export all entries.
     *
     * @param $addon
     * @param $namespace
     * @param $stream
     * @return \Illuminate\Http\RedirectResponse
     */
    public function export($addon, $namespace, $stream)
    {
        $addon = $this->addons->get($addon);

        /* @var StreamInterface $stream */
        $stream = $this->streams->findBySlugAndNamespace($stream, $namespace);

        /*
         * Resolve the model and set
         * it on the repository.
         */
        $this->repository->setModel($this->container->make($stream->getEntryModelName()));

        if (!$this->authorizer->authorize($addon->getNamespace($stream->getSlug() . '.read'))) {
            abort(403);
        }

        $headers = [
            'Content-Disposition' => 'attachment; filename=' . $stream->getSlug() . '.csv',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Pragma'              => 'public',
            'Expires'             => '0',
        ];

        $callback = function () {
            $output = fopen('php://output', 'w');

            foreach ($this->repository->allWithoutRelations() as $k => $entry) {
                if ($k == 0) {
                    fputcsv($output, array_keys($entry->toArray()));
                }

                fputcsv($output, $entry->toArray());
            }

            fclose($output);
        };

        return $this->response->stream($callback, 200, $headers);
    }
}
