<?php namespace Anomaly\Streams\Platform\Version\Table;

use Anomaly\Streams\Platform\Version\Contract\VersionInterface;

/**
 * Class VersionTableColumns
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class VersionTableColumns
{

    /**
     * Handle the columns.
     *
     * @param VersionTableBuilder $builder
     */
    public function handle(VersionTableBuilder $builder)
    {
        $date = config('streams::datetime.date_format');
        $time = config('streams::datetime.time_format');

        $builder->setColumns(
            [
                'author'     => [
                    'heading'    => 'streams::label.author',
                    'wrapper'    => '
                        <strong>{value.name}</strong>
                        <br>
                        {value.email}
                        <br>
                        <small class="text-muted">{value.ip_address}</small>
                        ',
                    'value'      => [
                        'ip_address' => 'entry.ip_address',
                        'email'      => 'entry.created_by.email',
                        'name'       => 'entry.created_by.display_name',
                    ],
                    //'sort_column' => 'name',
                    'attributes' => [
                        'style' => 'width: 250px;',
                    ],
                ],
                'created_at' => [
                    'heading'     => 'streams::label.date',
                    'sort_column' => 'created_at',
                    'wrapper'     => '
                        {value.datetime}
                        <br>
                        <small class="text-muted">{value.timeago}</small>',
                    'value'       => [
                        'datetime' => "entry.created_at.format('{$date} {$time}')",
                        'timeago'  => 'entry.created_at.diffForHumans()',
                    ],
                ],
                'changes'    => [
                    'heading' => false,
                    'value'   => function (VersionInterface $entry) {

                        if (!$count = $count = count($entry->getData())) {
                            return null;
                        }

                        return '<span class="tag tag-warning">' . $count . ' ' . trans_choice(
                                'streams::version.changes',
                                $count
                            ) . '</span>';
                    },
                ],
            ]
        );
    }
}
