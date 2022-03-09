<?php namespace Anomaly\UsersModule\User\Permission;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Translation\Translator;

/**
 * Class PermissionFormSections
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PermissionFormSections
{

    /**
     * Handle the fields.
     *
     * @param PermissionFormBuilder $builder
     * @param AddonCollection $addons
     * @param Translator $translator
     * @param Repository $config
     */
    public function handle(PermissionFormBuilder $builder, AddonCollection $addons, Repository $config)
    {
        $sections = [];

        $sections['streams']['title'] = 'streams::message.system';

        foreach ($config->get('streams::permissions', []) as $group => $permissions) {
            $sections['streams']['fields'][] = 'streams::' . $group;
        }

        /* @var Addon $addon */
        foreach ($addons->withConfig('permissions') as $addon) {

            $sections[$addon->getNamespace()]['title']       = $addon->getName();
            $sections[$addon->getNamespace()]['description'] = $addon->getDescription();

            foreach ($config->get($addon->getNamespace('permissions'), []) as $group => $permissions) {

                $sections[$addon->getNamespace()]['fields'][] = str_replace('.', '_', $addon->getNamespace($group));
            }
        }

        /**
         * Allow custom configured permissions
         * to be hooked in to the form as well.
         */
        if ($permissions = $config->get('anomaly.module.users::config.permissions')) {

            foreach ($permissions as $namespace => $group) {

                if ($title = array_get($group, 'title')) {
                    $sections[$namespace]['title'] = $title;
                }

                if ($description = array_get($group, 'description')) {
                    $sections[$namespace]['description'] = $description;
                }

                $sections[$namespace]['fields'] = array_get($sections[$namespace], 'fields', []);

                $sections[$namespace]['fields'] += array_map(
                    function ($permission) use ($namespace) {
                        return str_replace('.', '_', $namespace . '::' . $permission);
                    },
                    array_keys(array_get($group, 'permissions'))
                );
            }
        }

        $builder->setSections($sections);
    }
}
