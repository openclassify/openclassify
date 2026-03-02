<?php namespace Visiosoft\MultipleFieldType;

use Visiosoft\MultipleFieldType\Handler\Related;
use Visiosoft\MultipleFieldType\Table\LookupTableBuilder;
use Visiosoft\MultipleFieldType\Table\SelectedTableBuilder;
use Visiosoft\MultipleFieldType\Table\ValueTableBuilder;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Illuminate\Contracts\Container\Container;

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
        'streams/multiple-field_type/json/{key}'     => 'Visiosoft\MultipleFieldType\Http\Controller\LookupController@json',
        'streams/multiple-field_type/index/{key}'    => 'Visiosoft\MultipleFieldType\Http\Controller\LookupController@index',
        'streams/v-multiple-field_type/selected/{key}' => 'Visiosoft\MultipleFieldType\Http\Controller\LookupController@selected',
    ];

    /**
     * Register the addon.
     *
     * @param EntryModel $model
     */
    public function register(EntryModel $model)
    {
        $model->bind(
            'new_v_multiple_field_type_lookup_table_builder',
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
            'new_v_multiple_field_type_value_table_builder',
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
            'new_v_multiple_field_type_selected_table_builder',
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
            'get_v_multiple_field_type_options_handler',
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
