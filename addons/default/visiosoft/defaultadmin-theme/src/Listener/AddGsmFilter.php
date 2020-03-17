<?php namespace Visiosoft\DefaultadminTheme\Listener;

use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Type\SearchFilter;
use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\Table\UserTableBuilder;
use Illuminate\Database\Eloquent\Builder;

class AddGsmFilter
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * AddGsmFilter constructor.
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
        $query = $event->getQuery();

        if (get_class($builder) == UserTableBuilder::class) {
            $this->addGsmFilter($builder);
            $this->getFilteredQuery($query);
        }
    }

    /**
     * Add a filter for gsm phone.
     *
     * @param UserTableBuilder $builder
     */
    protected function addGsmFilter(UserTableBuilder $builder)
    {
        $filter = new SearchFilter();
        $filter->setPlaceholder(trans('visiosoft.theme.defaultadmin::control_panel.search_by_gsm_number'));
        $filter->setSlug('gsm_phone');

        $builder->getTable()->addFilter($filter);
        $builder->setColumns([
                'email',
                'gsm_phone',
                'status' => [
                    'value' => 'entry.status_label',
                ],]
        );
        $c = Collection::make([
            ['heading' => 'anomaly.module.users::field.email.name'],
            ['heading' => 'visiosoft.module.profile::field.gsm_phone.name'],
            ['heading' => 'anomaly.module.users::field.status.name'],
        ]);
        $builder->getTable()->setHeaders($c);
    }

    /**
     * Filter by gsm phone if present in request.
     *
     * @param Builder $query
     * @return Builder
     */
    protected function getFilteredQuery(Builder $query)
    {
        if ($filterGsmPhone = request('filter_gsm_phone')) {
            $query->where('gsm_phone', 'LIKE', '%' . preg_replace('/\s+/', '', $filterGsmPhone) . '%');
        }

        return $query;
    }
}