<?php namespace Anomaly\Streams\Platform\Ui\Form\Multiple\Command;

use Anomaly\Streams\Platform\Ui\Form\Command\HandleVersioning;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class VersionForms
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class VersionForms
{

    use DispatchesJobs;

    /**
     * The multiple form builder.
     *
     * @var MultipleFormBuilder
     */
    protected $builder;

    /**
     * Create a new VersionForms instance.
     *
     * @param MultipleFormBuilder $builder
     */
    public function __construct(MultipleFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param Request $request
     */
    public function handle(Request $request)
    {
        if (!$request->isMethod('post')) {
            return;
        }

        $this->builder->fire('versioning_forms', ['builder' => $this->builder]);

        /* @var FormBuilder $builder */
        foreach ($forms = $this->builder->getForms() as $slug => $builder) {

            $this->builder->fire('versioning_' . $slug, compact('builder', 'forms'));

            $this->dispatchNow(new HandleVersioning($builder));
        }
    }
}
