<?php namespace Anomaly\FilesModule\Disk\Adapter\Form;

use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Disk\Form\DiskFormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class AdapterFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AdapterFormBuilder extends MultipleFormBuilder
{

    /**
     * Fired just before saving the configuration.
     */
    public function onSavingConfiguration()
    {
        /* @var DiskFormBuilder $disk */
        $disk = $this->forms->get('disk');

        /* @var DiskInterface $entry */
        $entry = $disk->getFormEntry();

        /* @var ConfigurationFormBuilder $configuration */
        $configuration = $this->forms->get('configuration');

        if (!$configuration->getScope()) {
            $configuration->setScope($entry->getSlug());
        }
    }
}
