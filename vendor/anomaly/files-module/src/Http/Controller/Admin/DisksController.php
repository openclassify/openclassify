<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\FilesModule\Disk\Adapter\Form\AdapterFormBuilder;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Disk\Form\DiskFormBuilder;
use Anomaly\FilesModule\Disk\Table\DiskTableBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class DisksController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DisksController extends AdminController
{

    /**
     * Return an index of existing disks.
     *
     * @param  DiskTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(DiskTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return an ajax modal to choose the type
     * of adapter to use for creating a new disk.
     *
     * @param  ExtensionCollection $extensions
     * @return \Illuminate\View\View
     */
    public function choose(ExtensionCollection $extensions)
    {
        return view(
            'anomaly.module.files::ajax/choose_adapter',
            [
                'adapters' => $extensions->search('anomaly.module.files::adapter.*')->enabled(),
            ]
        );
    }

    /**
     * Return the form to create a new disk.
     *
     * @param  DiskFormBuilder          $disk
     * @param  AdapterFormBuilder       $form
     * @param  ExtensionCollection      $adapters
     * @param  ConfigurationFormBuilder $configuration
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        DiskFormBuilder $disk,
        AdapterFormBuilder $form,
        ExtensionCollection $adapters,
        ConfigurationFormBuilder $configuration
    ) {
        $adapter = $adapter = $adapters->get($this->request->input('adapter'));

        $form->addForm('disk', $disk->setAdapter($adapter));
        $form->addForm('configuration', $configuration->setEntry($adapter->getNamespace()));

        $form->on(
            'saving_configuration',
            function () use ($form) {

                /* @var ConfigurationFormBuilder $configuration */
                $disk          = $form->getChildFormEntry('disk');
                $configuration = $form->getChildForm('configuration');

                $configuration->setScope($disk->getSlug());
            }
        );

        return $form->render();
    }

    /**
     * Return the form to edit an existing disk.
     *
     * @param  DiskFormBuilder                            $disk
     * @param  AdapterFormBuilder                         $form
     * @param  DiskRepositoryInterface                    $disks
     * @param  ConfigurationFormBuilder                   $configuration
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        DiskFormBuilder $disk,
        AdapterFormBuilder $form,
        DiskRepositoryInterface $disks,
        ConfigurationFormBuilder $configuration,
        $id
    ) {
        $entry = $disks->find($id);

        $adapter = $entry->getAdapter();

        $form->addForm('disk', $disk->setEntry($id)->setAdapter($adapter));
        $form->addForm(
            'configuration',
            $configuration->setEntry($adapter->getNamespace())->setScope($entry->getSlug())
        );

        return $form->render();
    }
}
