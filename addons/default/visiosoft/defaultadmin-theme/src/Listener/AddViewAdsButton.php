<?php namespace Visiosoft\DefaultadminTheme\Listener;

use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\Table\UserTableBuilder;

class AddViewAdsButton
{

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * AddViewAdsAction constructor.
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
            $this->addViewAdsButton($builder);
        }
    }

    /**
     * Add a button to view ads.
     *
     * @param UserTableBuilder $builder
     */
    protected function addViewAdsButton(UserTableBuilder $builder)
    {
        $buttons = $builder->getButtons();
        if (isset($buttons['settings'])) {
            $dropdown = array_merge($buttons['settings']['dropdown'], [
                "ads" => [
                    "text" => trans('visiosoft.theme.defaultadmin::button.view_ads'),
                    "href" => "admin/advs?filter_User={entry.id}"
                ]
            ]);
            $buttons['settings']['dropdown'] = $dropdown;
            $builder->setButtons($buttons);
        }
    }
}