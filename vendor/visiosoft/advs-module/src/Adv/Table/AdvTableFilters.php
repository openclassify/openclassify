<?php namespace Visiosoft\AdvsModule\Adv\Table;

use Visiosoft\AdvsModule\Adv\Table\Filter\CategoryFilterQuery;
use Visiosoft\AdvsModule\Adv\Table\Filter\CityFilterQuery;
use Visiosoft\AdvsModule\Adv\Table\Filter\IdFilterQuery;
use Visiosoft\AdvsModule\Adv\Table\Filter\NameDescFilterQuery;
use Visiosoft\AdvsModule\Adv\Table\Filter\StatusFilterQuery;
use Visiosoft\AdvsModule\Adv\Table\Filter\UserFilterQuery;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;

class AdvTableFilters
{
    public function handle(AdvTableBuilder $builder, CategoryRepositoryInterface $categoryRepository, CityRepositoryInterface $cityRepository)
    {
        $cities = $cityRepository->all()->pluck('name', 'id')->all();

        $categories = $categoryRepository->getMainCategories()->pluck('name', 'id')->all();

        $builder->setFilters(
            [
                'search' => [
                    'filter' => 'input',
                    'placeholder' => 'visiosoft.module.advs::field.search',
                    'query' => NameDescFilterQuery::class,
                ],
                'country',
                'id' => [
                    'heading' => 'ID',
                    'filter' => 'input',
                    'query' => IdFilterQuery::class,
                ],
                'City' => [
                    'exact' => true,
                    'filter' => 'select',
                    'query' => CityFilterQuery::class,
                    'options' => $cities,
                ],
                'Category' => [
                    'exact' => true,
                    'filter' => 'select',
                    'query' => CategoryFilterQuery::class,
                    'options' => $categories,
                ],
                'user' => [
                    'exact' => true,
                    'filter' => 'select',
                    'query' => UserFilterQuery::class,
                ],
                'status' => [
                    'filter' => 'select',
                    'query' => StatusFilterQuery::class,
                    'options' => [
                        'approved' => 'visiosoft.module.advs::field.status.option.approved',
                        'expired' => 'visiosoft.module.advs::field.status.option.expired',
                        'unpublished' => 'visiosoft.module.advs::field.status.option.unpublished',
                        'pending_admin' => 'visiosoft.module.advs::field.status.option.pending_admin',
                        'pending_user' => 'visiosoft.module.advs::field.status.option.pending_user',
                    ],
                ]
            ]
        );
    }
}
