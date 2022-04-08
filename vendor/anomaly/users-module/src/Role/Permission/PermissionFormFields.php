<?php namespace Anomaly\UsersModule\Role\Permission;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\UsersModule\Role\Contract\RoleInterface;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Translation\Translator;

/**
 * Class PermissionFormFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PermissionFormFields
{

    /**
     * Handle the fields.
     *
     * @param PermissionFormBuilder $builder
     * @param AddonCollection $addons
     * @param Translator $translator
     * @param Repository $config
     */
    public function handle(
        PermissionFormBuilder $builder,
        AddonCollection $addons,
        Translator $translator,
        Repository $config
    ) {
        /* @var RoleInterface $role */
        $role = $builder->getEntry();

        $fields = [];

        $namespaces = array_merge(['streams'], $addons->withConfig('permissions')->namespaces());

        /*
         * gather all the addons with a
         * permissions configuration file.
         *
         * @var Addon $addon
         */
        foreach ($namespaces as $namespace) {

            foreach ($config->get($namespace . '::permissions', []) as $group => $permissions) {

                /*
                 * Determine the general
                 * form UI components.
                 */
                $label = $namespace . '::permission.' . $group . '.name';

                if (!$translator->has($warning = $namespace . '::permission.' . $group . '.warning')) {
                    $warning = null;
                }

                if (!$translator->has($instructions = $namespace . '::permission.' . $group . '.instructions')) {
                    $instructions = null;
                }

                /*
                 * Gather the available
                 * permissions for the group.
                 */
                $available = array_combine(
                    array_map(
                        function ($permission) use ($namespace, $group) {
                            return $namespace . '::' . $group . '.' . $permission;
                        },
                        $permissions
                    ),
                    array_map(
                        function ($permission) use ($namespace, $group) {
                            return $namespace . '::permission.' . $group . '.option.' . $permission;
                        },
                        $permissions
                    )
                );

                /*
                 * Build the checkboxes field
                 * type to handle the UI.
                 */
                $fields[str_replace('.', '_', $namespace . '::' . $group)] = [
                    'label'        => $label,
                    'warning'      => $warning,
                    'instructions' => $instructions,
                    'type'         => 'anomaly.field_type.checkboxes',
                    'value'        => $role->getPermissions(),
                    'config'       => [
                        'options' => $available,
                    ],
                ];
            }
        }

        /**
         * Allow custom configured permissions
         * to be hooked in to the form as well.
         */
        if ($permissions = $config->get('anomaly.module.users::config.permissions')) {

            foreach ($permissions as $namespace => $group) {
                foreach (array_get($group, 'permissions', []) as $permission => $permissions) {
                    $fields[str_replace('.', '_', $namespace . '::' . $permission)] = [
                        'label'        => array_get($permissions, 'label'),
                        'warning'      => array_get($permissions, 'warning'),
                        'instructions' => array_get($permissions, 'instructions'),
                        'type'         => 'anomaly.field_type.checkboxes',
                        'value'        => $role->getPermissions(),
                        'config'       => [
                            'options' => array_get($permissions, 'available', []),
                        ],
                    ];
                }
            }
        }

        $builder->setFields($fields);
    }
}
