<?php namespace Anomaly\NavigationModule\Link\Support\MultipleFieldType;

/**
 * Class ValueTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ValueTableBuilder extends \Anomaly\MultipleFieldType\Table\ValueTableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'link' => [
            'heading'     => 'anomaly.module.navigation::label.link',
            'sort_column' => 'title',
            'wrapper'     => '
                    <strong>{value.title}</strong>
                    <br>
                    <small class="text-muted">{value.url}</small>',
            'value'       => [
                'url'   => 'entry.url',
                'title' => 'entry.title',
            ],
        ],
        'entry.type.title',
        'menu',
    ];

}
