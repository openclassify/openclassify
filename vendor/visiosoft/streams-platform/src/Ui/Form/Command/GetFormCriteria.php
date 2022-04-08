<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Support\Presenter;
use Anomaly\Streams\Platform\Ui\Form\FormCriteria;
use Anomaly\Streams\Platform\Ui\Form\FormFactory;

/**
 * Class GetFormCriteria
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetFormCriteria
{

    /**
     * The builder parameters.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Create a new GetFormCriteria instance.
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
     * @param  FormFactory  $factory
     * @return FormCriteria
     */
    public function handle(FormFactory $factory)
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
                'entry'     => $this->parameters->getId(),
                'stream'    => $this->parameters->getStreamSlug(),
                'namespace' => $this->parameters->getStreamNamespace(),
            ];
        }

        return $factory->make($this->parameters);
    }
}
