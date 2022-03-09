<?php namespace Visiosoft\ConnectModule\Client\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Client;

/**
 * Class ClientTableBuilder
 *

 */
class ClientTableBuilder extends TableBuilder
{

    /**
     * The table model.
     *
     * @var Model
     */
    protected $model = Client::class;

    /**
     * The table filters.
     *
     * @var array
     */
    protected $filters = [
        'search' => [
            'columns' => [
                'name',
                'redirect',
            ],
        ],
    ];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'entry.id'   => [
            'sort_column' => 'id',
            'heading'     => 'visiosoft.module.connect::field.client.name',
        ],
        [
            'sort_column' => 'user_id',
            'value'       => '{{ user(entry.user_id).username }}',
            'heading'     => 'visiosoft.module.connect::field.user.name',
        ],
        'entry.name' => [
            'sort_column' => 'name',
            'heading'     => 'visiosoft.module.connect::field.name.name',
        ],
        'entry.secret' => [
            'sort_column' => 'secret',
            'heading'     => 'visiosoft.module.connect::field.secret.name',
        ],
    ];

    protected $buttons = [
        'edit'
    ];

    /**
     * The table actions.
     *
     * @var array
     */
    protected $actions = [
        'delete',
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'permission' => 'visiosoft.module.connect::clients.read',
    ];
}
