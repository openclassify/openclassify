<?php namespace Anomaly\BlocksModule;

use Anomaly\BlocksModule\Area\AreaModel;
use Anomaly\BlocksModule\Area\AreaRepository;
use Anomaly\BlocksModule\Area\Contract\AreaRepositoryInterface;
use Anomaly\BlocksModule\Block\BlockCategories;
use Anomaly\BlocksModule\Block\BlockModel;
use Anomaly\BlocksModule\Block\BlockRepository;
use Anomaly\BlocksModule\Block\Contract\BlockRepositoryInterface;
use Anomaly\BlocksModule\Http\Controller\Admin\AssignmentsController;
use Anomaly\BlocksModule\Http\Controller\Admin\FieldsController;
use Anomaly\BlocksModule\Type\Command\RegisterBlocks;
use Anomaly\BlocksModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\BlocksModule\Type\TypeModel;
use Anomaly\BlocksModule\Type\TypeRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Assignment\AssignmentRouter;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Field\FieldRouter;
use Anomaly\Streams\Platform\Model\Blocks\BlocksAreasEntryModel;
use Anomaly\Streams\Platform\Model\Blocks\BlocksTypesEntryModel;

/**
 * Class BlocksModuleServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BlocksModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        BlocksModulePlugin::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/blocks'                        => 'Anomaly\BlocksModule\Http\Controller\Admin\AreasController@index',
        'admin/blocks/create'                 => 'Anomaly\BlocksModule\Http\Controller\Admin\AreasController@create',
        'admin/blocks/choose'                 => 'Anomaly\BlocksModule\Http\Controller\Admin\AreasController@choose',
        'admin/blocks/edit/{id}'              => 'Anomaly\BlocksModule\Http\Controller\Admin\AreasController@edit',
        'admin/blocks/types'                  => 'Anomaly\BlocksModule\Http\Controller\Admin\TypesController@index',
        'admin/blocks/types/create'           => 'Anomaly\BlocksModule\Http\Controller\Admin\TypesController@create',
        'admin/blocks/types/edit/{id}'        => 'Anomaly\BlocksModule\Http\Controller\Admin\TypesController@edit',
        'admin/blocks/areas/{area}'           => 'Anomaly\BlocksModule\Http\Controller\Admin\BlocksController@index',
        'admin/blocks/areas/{area}/create'    => 'Anomaly\BlocksModule\Http\Controller\Admin\BlocksController@create',
        'admin/blocks/areas/{area}/choose'    => 'Anomaly\BlocksModule\Http\Controller\Admin\BlocksController@choose',
        'admin/blocks/areas/{area}/edit/{id}' => 'Anomaly\BlocksModule\Http\Controller\Admin\BlocksController@edit',
    ];

    /**
     * The addon bindings.
     *
     * @var array
     */
    protected $bindings = [
        BlocksAreasEntryModel::class => AreaModel::class,
        BlocksTypesEntryModel::class => TypeModel::class,
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        BlockCategories::class          => BlockCategories::class,
        AreaRepositoryInterface::class  => AreaRepository::class,
        TypeRepositoryInterface::class  => TypeRepository::class,
        BlockRepositoryInterface::class => BlockRepository::class,
    ];

    /**
     * Boot the addon.
     */
    public function boot()
    {
        if (class_exists(BlocksTypesEntryModel::class)) {
            $this->dispatch(new RegisterBlocks());
        }
    }

    /**
     * Register the addon.
     *
     * @param EntryModel $model
     */
    public function register(EntryModel $model)
    {

        /**
         * Register global block
         * area relation methods.
         */
        $model->bind(
            'blocks',
            function ($field = 'blocks') {

                /* @var EntryInterface $this */
                $field = $this->getField($field);

                return $this
                    ->morphMany(BlockModel::class, 'area', 'area_type')
                    ->where('field_id', $field->getId());
            }
        );

        $model->bind(
            'get_blocks',
            function ($field = 'blocks') {

                /* @var EntryInterface $this */
                return $this
                    ->call('blocks', compact('field'))
                    ->getResults();
            }
        );
    }

    /**
     * Map additional routes.
     *
     * @param FieldRouter $fields
     * @param AssignmentRouter $assignments
     */
    public function map(FieldRouter $fields, AssignmentRouter $assignments)
    {
        $fields->route($this->addon, FieldsController::class);
        $assignments->route($this->addon, AssignmentsController::class, 'admin/blocks/types');
    }

}
