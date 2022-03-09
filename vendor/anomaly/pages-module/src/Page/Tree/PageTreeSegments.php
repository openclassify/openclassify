<?php namespace Anomaly\PagesModule\Page\Tree;

use Anomaly\PagesModule\Page\Contract\PageInterface;

/**
 * Class PageTreeSegments
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PageTreeSegments
{

    /**
     * Handle the tree segments.
     *
     * @param PageTreeBuilder $builder
     */
    public function handle(PageTreeBuilder $builder)
    {
        $builder->setSegments(
            [
                'title' => [
                    'href' => 'admin/pages/edit/{entry.id}',
                ],
                [
                    'class' => 'text-faded',
                    'value' => function (PageInterface $entry) {
                        return '<span class="small" style="padding-right:10px;">' . $entry->type->name . '</span>';
                    },
                ],
                [
                    'data-toggle' => 'tooltip',
                    'class'       => 'text-success',
                    'value'       => '<i class="fa fa-home"></i>',
                    'attributes'  => [
                        'title' => 'module::message.home',
                    ],
                    'enabled'     => function (PageInterface $entry) {
                        return $entry->isHome();
                    },
                ],
                [
                    'data-toggle' => 'tooltip',
                    'class'       => 'text-muted',
                    'value'       => '<i class="fa fa-chain-broken"></i>',
                    'attributes'  => [
                        'title' => 'module::message.hidden',
                    ],
                    'enabled'     => function (PageInterface $entry) {
                        return !$entry->isVisible();
                    },
                ],
                [
                    'data-toggle' => 'tooltip',
                    'class'       => 'text-muted',
                    'value'       => '<i class="fa fa-lock"></i>',
                    'attributes'  => [
                        'title' => 'module::message.restricted',
                    ],
                    'enabled'     => function (PageInterface $entry) {

                        $roles = $entry->getAllowedRoles();

                        return !$roles->isEmpty();
                    },
                ],
                [
                    'data-toggle' => 'tooltip',
                    'class'       => 'text-danger',
                    'value'       => '<i class="fa fa-ban"></i>',
                    'attributes'  => [
                        'title' => 'module::message.disabled',
                    ],
                    'enabled'     => function (PageInterface $entry) {
                        return !$entry->isEnabled();
                    },
                ],
                [
                    'data-toggle' => 'tooltip',
                    'class'       => 'text-info',
                    'value'       => '<i class="fa fa-clock-o"></i>',
                    'attributes'  => [
                        'title' => 'module::message.scheduled',
                    ],
                    'enabled'     => function (PageInterface $entry) {
                        return !$entry->isPublished();
                    },
                ],
            ]
        );
    }
}
