<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Button;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Http\Request;

/**
 * Class ButtonDefaults
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ButtonDefaults
{

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new ButtonDefaults instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Default the form buttons when none are defined.
     *
     * @param FormBuilder $builder
     */
    public function defaults(FormBuilder $builder)
    {
        if ($builder->getButtons() === [] && $this->request->segment(1) == 'admin') {
            $builder->addButton('cancel');
        }
    }
}
