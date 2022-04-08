<?php namespace Anomaly\MultipleFieldType;

use Anomaly\MultipleFieldType\Handler\Related;
use Anomaly\MultipleFieldType\Table\LookupTableBuilder;
use Anomaly\MultipleFieldType\Table\SelectedTableBuilder;
use Anomaly\MultipleFieldType\Table\ValueTableBuilder;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Illuminate\Contracts\Container\Container;

/**
 * Class MultipleFieldTypeServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class MultipleFieldTypeServiceProvider extends AddonServiceProvider
{

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        MultipleFieldTypeAccessor::class => MultipleFieldTypeAccessor::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'streams/multiple-field_type/json/{key}'     => 'Anomaly\MultipleFieldType\Http\Controller\LookupController@json',
        'streams/multiple-field_type/index/{key}'    => 'Anomaly\MultipleFieldType\Http\Controller\LookupController@index',
        'streams/multiple-field_type/selected/{key}' => 'Anomaly\MultipleFieldType\Http\Controller\LookupController@selected',
    ];

    /**
     * Register the addon.
     *
     * @param EntryModel $model
     */
    public function register(EntryModel $model)
    {
        $model->bind(
            'new_multiple_field_type_lookup_table_builder',
            function (Container $container) {

                /* @var EntryInterface $this */
                $builder = $this->getBoundModelNamespace() . '\\Support\\MultipleFieldType\\LookupTableBuilder';

                if (class_exists($builder)) {
                    return $container->make($builder);
                }

                return $container->make(LookupTableBuilder::class);
            }
        );

        $model->bind(
            'new_multiple_field_type_value_table_builder',
            function (Container $container) {

                /* @var EntryInterface $this */
                $builder = $this->getBoundModelNamespace() . '\\Support\\MultipleFieldType\\ValueTableBuilder';

                if (class_exists($builder)) {
                    return $container->make($builder);
                }

                return $container->make(ValueTableBuilder::class);
            }
        );

        $model->bind(
            'new_multiple_field_type_selected_table_builder',
            function (Container $container) {

                /* @var EntryInterface $this */
                $builder = $this->getBoundModelNamespace() . '\\Support\\MultipleFieldType\\SelectedTableBuilder';

                if (class_exists($builder)) {
                    return $container->make($builder);
                }

                return $container->make(SelectedTableBuilder::class);
            }
        );

        $model->bind(
            'get_multiple_field_type_options_handler',
            function () {

                /* @var EntryInterface $this */
                $handler = $this->getBoundModelNamespace() . '\\Support\\MultipleFieldType\\OptionsHandler';

                if (class_exists($handler)) {
                    return $handler;
                }

                return Related::class;
            }
        );
    }
}
