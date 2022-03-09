<?php namespace Anomaly\UsersModule\Role\Form;

/**
 * Class RoleFormFields
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RoleFormFields
{

    /**
     * Handle the form fields.
     *
     * @param RoleFormBuilder $builder
     */
    public function handle(RoleFormBuilder $builder)
    {
        $entry = $builder->getFormEntry();

        $builder->setFields(
            [
                'name',
                'slug' => [
                    'disabled' => $entry->getSlug() == 'admin',
                ],
                'description',
            ]
        );
    }
}
