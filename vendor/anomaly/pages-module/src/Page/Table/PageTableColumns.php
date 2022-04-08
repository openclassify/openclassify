<?php namespace Anomaly\PagesModule\Page\Table;

use Anomaly\PagesModule\Page\Contract\PageInterface;

/**
 * Class PageTableColumns
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageTableColumns
{

    /**
     * Handle the table columns.
     *
     * @param PageTableBuilder $builder
     */
    public function handle(PageTableBuilder $builder)
    {
        $builder->setColumns(
            [
                'title' => [
                    'sort_column' => 'path',
                    'wrapper'     => '
                    <strong>{value.title}</strong>
                    &nbsp;
                    {value.home} {value.visible} {value.locked} {value.scheduled}
                    <br>
                    <small class="text-muted">{value.path}</small>',
                    'value'       => [
                        'path'    => 'entry.path',
                        'title'   => 'entry.title',
                        'home'    => function (PageInterface $entry) {

                            if (!$entry->isHome()) {
                                return null;
                            }

                            return '<i class="fa fa-home text-success"></i>';
                        },
                        'visible' => function (PageInterface $entry) {

                            if ($entry->isVisible()) {
                                return null;
                            }

                            return '<i class="fa fa-chain-broken text-muted"></i>';
                        },
                        'locked'  => function (PageInterface $entry) {

                            $roles = $entry->getAllowedRoles();

                            if ($roles->isEmpty()) {
                                return null;
                            }

                            return '<i class="fa fa-lock text-muted"></i>';
                        },
                        'scheduled'  => function (PageInterface $entry) {

                            if ($entry->isPublished()) {
                                return null;
                            }

                            return '<i class="fa fa-clock-o text-info"></i>';
                        },
                    ],
                ],
                'type',
            ]
        );
    }
}
