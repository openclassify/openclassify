<?php namespace Anomaly\VariablesModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Anomaly\Streams\Platform\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Version\Table\VersionTableBuilder;

/**
 * Class VersionsController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class VersionsController extends \Anomaly\Streams\Platform\Http\Controller\VersionsController
{

    /**
     * The streams repository.
     *
     * @var StreamRepositoryInterface
     */
    protected $streams;

    /**
     * Create a new VersionsController instance.
     *
     * @param StreamRepositoryInterface $streams
     */
    public function __construct(StreamRepositoryInterface $streams)
    {
        parent::__construct();

        $this->streams = $streams;
    }

    /**
     * Return a list of versions for the variable group.
     *
     * @param VersionTableBuilder $table
     * @param                     $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(VersionTableBuilder $table)
    {

        /**
         * Mimic the parent controllers method.
         */
        $table
            ->setType($this->getModel())
            ->setId($this->request->route('id'));

        $versionable = $table->getVersionableInstance();

        if ($current = $versionable->getCurrentVersion()) {
            $table->setCurrent($current);
        }

        /* @var ControlPanelBuilder $controlPanel */
        $controlPanel = $this->container->make(ControlPanelBuilder::class);

        $section = $controlPanel->getControlPanelActiveSection();

        /**
         * Mimic the default table buttons handler
         * and override the href so that we edit
         * the group and not the versionable ID.
         */
        $table->setButtons(
            [
                'load'    => [
                    'href'     => $section->getHref(
                        'edit/{request.input.group}?version={entry.version}&versionable={entry.versionable_type}'
                    ),
                    'disabled' => function (VersionInterface $entry) use ($current) {

                        if ($current->getVersion() !== $entry->getVersion()) {
                            return false;
                        }

                        return true;
                    },
                ],
            ]
        );

        return $table->render();
    }

    /**
     * Get the model.
     *
     * @return null|string
     */
    public function getModel()
    {
        /* @var StreamInterface $stream */
        if ($stream = $this->streams->find($this->request->get('group'))) {
            return $stream->getEntryModelName();
        }

        return parent::getModel();
    }

}
