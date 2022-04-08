<?php namespace Anomaly\PostsModule\Post\Form;

use Illuminate\Contracts\Auth\Guard;

/**
 * Class PostFormFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PostFormFields
{

    /**
     * Handle the form fields.
     *
     * @param Guard           $auth
     * @param PostFormBuilder $builder
     */
    public function handle(Guard $auth, PostFormBuilder $builder)
    {
        $builder->setFields(
            [
                '*',
                'author'     => [
                    'config' => [
                        'default_value' => $auth->id(),
                    ],
                ],
                'publish_at' => [
                    'config' => [
                        'default_value' => 'now',
                    ],
                ],
            ]
        );
    }
}
