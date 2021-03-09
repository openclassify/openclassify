<?php namespace Visiosoft\DefaultadminTheme\Listener;

use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Ui\Table\Component\Header\Header;
use Illuminate\Support\Collection;
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
        	    'first_name',
                'last_name',
                'email' => [
                    'value' => function (EntryModel $entry) {
                        return str_ends_with($entry->email, '@example.com') ? '' : $entry->email;
                    }
                ],
                'gsm_phone',
                'created_at' => [
                    'value' => 'entry.created_at'
                ],
                'status' => [
                    'value' => 'entry.status_label',
                ],]
        );
        $builder->setOptions([
            'order_by' =>
                [
                    'email' => 'DESC'
                ],
        ]);

        $collection = new Collection();
	    $header_firstname = new Header();
        $header_firstname = $header_firstname->setBuilder($builder)->setHeading('anomaly.module.users::field.first_name.name');
        $header_lastname = new Header();
	    $header_lastname = $header_lastname->setBuilder($builder)->setHeading('anomaly.module.users::field.last_name.name');
        $header_email = new Header();
        $header_email = $header_email->setBuilder($builder)->setHeading('anomaly.module.users::field.email.name')->setSortable(true)->setSortColumn('email');
        $header_phone = new Header();
        $header_gsm_phone = $header_phone->setBuilder($builder)->setHeading('visiosoft.module.profile::field.gsm_phone.name');
        $header_created_at = new Header();
        $header_created_at = $header_created_at->setBuilder($builder)->setHeading('streams::entry.created_at')->setSortColumn('created_at')->setSortable(true);
        $header_status = new Header();
        $header_status = $header_status->setBuilder($builder)->setHeading('anomaly.module.users::field.status.name');

        $collection = $collection->add($header_firstname);
        $collection = $collection->add($header_lastname);
        $collection = $collection->add($header_email);
        $collection = $collection->add($header_gsm_phone);
        $collection = $collection->add($header_created_at);
        $collection = $collection->add($header_status);

        $builder->getTable()->setHeaders($collection);
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