<?php namespace Anomaly\RelationshipFieldType\Http\Controller;

use Anomaly\RelationshipFieldType\Command\GetConfiguration;
use Anomaly\RelationshipFieldType\Command\HydrateValueTable;
use Anomaly\RelationshipFieldType\Table\LookupTableBuilder;
use Anomaly\RelationshipFieldType\Table\ValueTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Container\Container;

/**
 * Class LookupController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\RelationshipFieldType\Http\Controller
 */
class LookupController extends AdminController
{

    /**
     * Return an index of entries from related stream.
     *
     * @param Container $container
     * @param           $key
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Container $container, $key)
    {
        /* @var Collection $config */
        $config = $this->dispatch(new GetConfiguration($key));

        $related = $container->make($config->get('related'));

        if ($table = $config->get('lookup_table')) {
            $table = $container->make($table);
        } else {
            $table = $related->newRelationshipFieldTypeLookupTableBuilder();
        }

        /* @var LookupTableBuilder $table */
        $table->setConfig($config)
            ->setModel($related);

        return $table->render();
    }

    /**
     * Return the selected entries.
     *
     * @param Container $container
     * @param           $key
     * @return null|string
     */
    public function selected(Container $container, $key)
    {
        /* @var Collection $config */
        $config = $this->dispatch(new GetConfiguration($key));

        $related = $container->make($config->get('related'));

        if ($table = $config->get('value_table')) {
            $table = $container->make($table);
        } else {
            $table = $related->newRelationshipFieldTypeValueTableBuilder();
        }

        /* @var ValueTableBuilder $table */
        $table->setSelected($this->request->get('uploaded'))
            ->setConfig($config)
            ->setModel($related)
            ->build()
            ->load();

        return $table->getTableContent();
    }
}
