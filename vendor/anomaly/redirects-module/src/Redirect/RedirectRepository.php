<?php namespace Anomaly\RedirectsModule\Redirect;

use Anomaly\RedirectsModule\Redirect\Contract\RedirectRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class RedirectRepository
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class RedirectRepository extends EntryRepository implements RedirectRepositoryInterface
{

    /**
     * The redirect model.
     *
     * @var RedirectModel
     */
    protected $model;

    /**
     * Create a new RedirectRepository instance.
     *
     * @param RedirectModel $model
     */
    public function __construct(RedirectModel $model)
    {
        $this->model = $model;
    }
}
