<?php namespace Anomaly\Streams\Platform\Ui\Table;

use Anomaly\Streams\Platform\Support\Authorizer;

/**
 * Class TableAuthorizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TableAuthorizer
{

    /**
     * The authorizer utility.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new TableAuthorizer instance.
     *
     * @param Authorizer $authorizer
     */
    public function __construct(Authorizer $authorizer)
    {
        $this->authorizer = $authorizer;
    }

    /**
     * Authorize the table.
     *
     * @param TableBuilder $builder
     */
    public function authorize(TableBuilder $builder)
    {
        // Try the option first.
        $permission = $builder->getTableOption('permission');

        if ($permission && !$this->authorizer->authorize($permission)) {
            abort(403);
        }
    }
}
