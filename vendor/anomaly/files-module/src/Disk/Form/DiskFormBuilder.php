<?php namespace Anomaly\FilesModule\Disk\Form;

use Anomaly\FilesModule\Disk\Adapter\Contract\AdapterInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class DiskFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DiskFormBuilder extends FormBuilder
{

    /**
     * The storage adapter.
     *
     * @var Extension|AdapterInterface|null
     */
    protected $adapter = null;

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'name',
        'slug' => [
            'disabled' => 'edit',
        ],
        'description',
    ];

    /**
     * The fields to skip.
     *
     * @var array
     */
    protected $skips = [
        'adapter',
    ];

    /**
     * Fired just before
     * saving the form entry.
     */
    public function onSaving()
    {
        $entry   = $this->getFormEntry();
        $adapter = $this->getAdapter();

        $entry->adapter = $adapter->getNamespace();
    }

    /**
     * Get the adapter.
     *
     * @return Extension|AdapterInterface|null
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Set the adapter.
     *
     * @param  AdapterInterface $adapter
     * @return $this
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;

        return $this;
    }
}
