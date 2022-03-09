<?php namespace Anomaly\Streams\Platform\Ui\Table\Command;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Support\Presenter;
use Anomaly\Streams\Platform\Ui\Table\TableCriteria;
use Anomaly\Streams\Platform\Ui\Table\TableFactory;

/**
 * Class GetTableCriteria
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetTableCriteria
{

    /**
     * The builder parameters.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Create a new GetTableCriteria instance.
     *
     * @param array $parameters
     */
    public function __construct($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Handle the command.
     *
     * @param  TableFactory $factory
     * @return TableCriteria
     */
    public function handle(TableFactory $factory)
    {
        if (is_string($this->parameters)) {
            $this->parameters = [
                'builder' => $this->parameters,
            ];
        }

        if ($this->parameters instanceof Presenter) {
            $this->parameters = $this->parameters->getObject();
        }

        if ($this->parameters instanceof EntryInterface) {
            $this->parameters = [
                'stream'    => $this->parameters->getStreamSlug(),
                'namespace' => $this->parameters->getStreamNamespace(),
            ];
        }

        return $factory->make($this->parameters);
    }
}
