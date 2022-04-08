<?php namespace Anomaly\DashboardModule\Widget\Form;

use Anomaly\DashboardModule\Dashboard\Contract\DashboardInterface;
use Anomaly\DashboardModule\Widget\Extension\WidgetExtension;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class WidgetFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class WidgetFormBuilder extends FormBuilder
{

    /**
     * The widget instance.
     *
     * @var null|WidgetExtension
     */
    protected $extension = null;

    /**
     * The dashboard instance.
     *
     * @var null|DashboardInterface
     */
    protected $dashboard = null;

    /**
     * The skipped fields.
     *
     * @var array
     */
    protected $skips = [
        'extension',
        'column',
    ];

    /**
     * Fired when the form is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getExtension() && !$this->getEntry()) {
            throw new \Exception('The $extension parameter is required when creating a page.');
        }
    }

    /**
     * Fired just before saving the form.
     */
    public function onSaving()
    {
        $entry     = $this->getFormEntry();
        $extension = $this->getExtension();

        if (!$entry->getId()) {
            $entry->extension = $extension->getNamespace();
        }
    }

    /**
     * Get the extension.
     *
     * @return null|WidgetExtension
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set the extension.
     *
     * @param  WidgetExtension $extension
     * @return $this
     */
    public function setExtension(WidgetExtension $extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get the dashboard.
     *
     * @return null|DashboardInterface
     */
    public function getDashboard()
    {
        return $this->dashboard;
    }

    /**
     * Set the dashboard.
     *
     * @param  DashboardInterface $dashboard
     * @return $this
     */
    public function setDashboard(DashboardInterface $dashboard)
    {
        $this->dashboard = $dashboard;

        return $this;
    }
}
