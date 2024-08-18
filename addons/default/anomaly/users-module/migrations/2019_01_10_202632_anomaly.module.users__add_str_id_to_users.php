<?php

use Anomaly\UsersModule\User\UserRepository;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\Streams\Platform\Entry\Command\AutoloadEntryModels;

/**
 * Class AnomalyModuleUsersAddStrIdToUsers
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleUsersAddStrIdToUsers extends Migration
{

    /**
     * Don't delete the stream.
     * Used for reference only.
     *
     * @var bool
     */
    protected $delete = false;

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'str_id' => 'anomaly.field_type.text',
    ];

    /**
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'users',
    ];

    /**
     * @var array
     */
    protected $assignments = [
        'str_id' => [
            'required' => true,
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up()
    {
        /**
         * Ensure the potentially newly generated
         * models are autoloaded so we can use them.
         */
        dispatch_sync(new AutoloadEntryModels());

        /**
         * Load the concrete on purpose.
         *
         * @var UserRepositoryInterface $users
         */
        $users = app(UserRepository::class);

        /* @var UserInterface|EloquentModel $user */
        foreach ($users->allWithTrashed() as $user) {

            if ($user->getStrId()) {
                continue;
            }

            $users->save($user->setRawAttribute('str_id', str_random(24)));
        }

        $field      = $this->fields()->findBySlugAndNamespace('str_id', 'users');
        $stream     = $this->streams()->findBySlugAndNamespace('users', 'users');
        $assignment = $this->assignments()->findByStreamAndField($stream, $field);

        $this->assignments()->save($assignment->setAttribute('unique', true));
    }

}
