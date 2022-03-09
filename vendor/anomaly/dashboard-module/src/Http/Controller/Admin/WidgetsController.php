<?php namespace Anomaly\DashboardModule\Http\Controller\Admin;

use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\DashboardModule\Widget\Contract\WidgetRepositoryInterface;
use Anomaly\DashboardModule\Widget\Extension\Form\WidgetExtensionFormBuilder;
use Anomaly\DashboardModule\Widget\Extension\WidgetExtension;
use Anomaly\DashboardModule\Widget\Form\WidgetFormBuilder;
use Anomaly\DashboardModule\Widget\Table\WidgetTableBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class WidgetsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class WidgetsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param  WidgetTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(WidgetTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return the modal for choosing a widget.
     *
     * @param  ExtensionCollection $extensions
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function choose(ExtensionCollection $extensions)
    {
        return $this->view->make(
            'module::admin/widgets/choose',
            [
                'widgets' => $extensions
                    ->search('anomaly.module.dashboard::widget.*')
                    ->enabled(),
            ]
        );
    }

    /**
     * Create a new entry.
     *
     * @param  ExtensionCollection                          $extensions
     * @param  WidgetExtensionFormBuilder|WidgetFormBuilder $form
     * @param  WidgetFormBuilder                            $widget
     * @param  ConfigurationFormBuilder                     $configuration
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        ExtensionCollection $extensions,
        WidgetExtensionFormBuilder $form,
        WidgetFormBuilder $widget,
        ConfigurationFormBuilder $configuration
    ) {
        /* @var WidgetExtension $extension */
        $extension = $extensions->get($this->request->get('widget'));

        $form->addForm('widget', $widget->setExtension($extension));
        $form->addForm('configuration', $configuration->setEntry($extension->getNamespace()));

        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param  WidgetExtensionFormBuilder|WidgetFormBuilder $form
     * @param  WidgetFormBuilder                            $widget
     * @param  ConfigurationFormBuilder                     $configuration
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        WidgetExtensionFormBuilder $form,
        WidgetFormBuilder $widget,
        ConfigurationFormBuilder $configuration,
        WidgetRepositoryInterface $widgets,
        $id
    ) {
        /* @var WidgetInterface $entry */
        $entry = $widgets->find($id);

        /* @var WidgetExtension $extension */
        $extension = $entry->getExtension();

        $form->setEntry($id);
        $form->addForm('widget', $widget->setEntry($id));
        $form->addForm('configuration', $configuration->setScope($id)->setEntry($extension->getNamespace()));

        return $form->render();
    }

    /**
     * Save the dashboard items order.
     *
     * @param WidgetRepositoryInterface $widgets
     */
    public function save(WidgetRepositoryInterface $widgets)
    {
        foreach (json_decode($this->request->get('columns')) as $column => $columns) {
            foreach ($columns as $position => $widget) {
                if ($widget = $widgets->find($widget)) {

                    $widget->setAttribute('column', $column + 1);
                    $widget->setAttribute('sort_order', $position + 1);

                    $widgets->save($widget);
                }
            }
        }
    }
}
