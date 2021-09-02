<?php namespace Visiosoft\DefaultadminTheme\Listener;

use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\Table\UserTableBuilder;

class AddViewClassifiedsButton
{

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * AddViewClassifiedsAction constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param TableIsQuerying $event
     */
    public function handle(TableIsQuerying $event)
    {
        $builder = $event->getBuilder();

        if (get_class($builder) == UserTableBuilder::class) {
            $this->addViewClassifiedsButton($builder);
        }
    }

    /**
     * Add a button to view classifieds.
     *
     * @param UserTableBuilder $builder
     */
    protected function addViewClassifiedsButton(UserTableBuilder $builder)
    {
        $buttons = $builder->getButtons();
        if (isset($buttons['settings'])) {
            $dropdown = array_merge($buttons['settings']['dropdown'], [
                "classifieds" => [
                    "text" => trans('visiosoft.theme.defaultadmin::button.view_classifieds'),
                    "href" => "admin/classifieds?filter_User={entry.id}"
                ]
            ]);
            $buttons['settings']['dropdown'] = $dropdown;
            $builder->setButtons($buttons);
        }
    }
}