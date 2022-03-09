<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Ui\Form\Component\Action\ActionResponder;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\ResponseFactory;

/**
 * Class SetJsonResponse
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetJsonResponse
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new SetJsonResponse instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param ResponseFactory $response
     * @param ActionResponder $responder
     */
    public function handle(ResponseFactory $response, ActionResponder $responder)
    {
        $data = new Collection();

        $original = $this->builder->getFormResponse();

        /**
         * If we already set our own JSON
         * response then just use that.
         */
        if ($original instanceof JsonResponse) {
            return;
        }

        /**
         * If we let the system set a redirect response
         * from the action handler then grab the redirect.
         */
        if ($action = $this->builder->getActiveFormAction()) {

            $responder->setFormResponse($this->builder, $action);

            if ($original instanceof RedirectResponse) {
                $data->put('redirect', $original->getTargetUrl());
            }
        }

        $data->put('success', !$this->builder->hasFormErrors());
        $data->put('errors', $this->builder->getFormErrors()->toArray());

        $this->builder->fire(
            'json_response',
            [
                'data'    => $data,
                'builder' => $this->builder,
            ]
        );

        $this->builder->setFormResponse(
            $response = $response->json($data)
        );
    }
}
