<?php namespace Visiosoft\ClassifiedsModule\Classified\Table;

use Visiosoft\ClassifiedsModule\Classified\Table\Filter\CategoryFilterQuery;
use Visiosoft\ClassifiedsModule\Classified\Table\Filter\CityFilterQuery;
use Visiosoft\ClassifiedsModule\Classified\Table\Filter\NameDescFilterQuery;
use Visiosoft\ClassifiedsModule\Classified\Table\Filter\StatusFilterQuery;
use Visiosoft\ClassifiedsModule\Classified\Table\Filter\UserFilterQuery;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;

class ClassifiedTableFilters
{
    public function handle(ClassifiedTableBuilder $builder, CategoryRepositoryInterface $categoryRepository, CityRepositoryInterface $cityRepository)
    {
        $cities = $cityRepository->all()->pluck('name', 'id')->all();

        $categories = $categoryRepository->getMainCategories()->pluck('name', 'id')->all();

        $builder->setFilters(
            [
                'search' => [
                    'filter' => 'input',
                    'placeholder' => 'visiosoft.module.classifieds::field.search',
                    'query' => NameDescFilterQuery::class,
                ],
                'country',
                'id' => [
                    'heading' => 'ID',
                    'filter' => 'input'
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
                        'approved' => 'visiosoft.module.classifieds::field.status.option.approved',
                        'expired' => 'visiosoft.module.classifieds::field.status.option.expired',
                        'unpublished' => 'visiosoft.module.classifieds::field.status.option.unpublished',
                        'pending_admin' => 'visiosoft.module.classifieds::field.status.option.pending_admin',
                        'pending_user' => 'visiosoft.module.classifieds::field.status.option.pending_user',
                    ],
                ]
            ]
        );
    }
}
