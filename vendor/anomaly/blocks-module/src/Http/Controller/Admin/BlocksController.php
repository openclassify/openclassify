<?php namespace Anomaly\BlocksModule\Http\Controller\Admin;

use Anomaly\BlocksModule\Area\Command\GetArea;
use Anomaly\BlocksModule\Area\Contract\AreaInterface;
use Anomaly\BlocksModule\Block\BlockExtension;
use Anomaly\BlocksModule\Block\Contract\BlockInterface;
use Anomaly\BlocksModule\Block\Contract\BlockRepositoryInterface;
use Anomaly\BlocksModule\Block\Form\BlockFormBuilder;
use Anomaly\BlocksModule\Block\Form\BlockInstanceFormBuilder;
use Anomaly\BlocksModule\Block\Table\BlockTableBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class BlocksController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BlocksController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param BlockTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(BlockTableBuilder $table, $area)
    {

        /* @var AreaInterface $area */
        if (!$area = $this->dispatch(new GetArea($area))) {
            abort(404);
        }

        $table->setArea($area);

        $table->setOption('title', $area->getTitle());
        $table->setOption('description', $area->getDescription());

        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param BlockInstanceFormBuilder|BlockFormBuilder $form
     * @param BlockFormBuilder $default
     * @param ExtensionCollection $extensions
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        BlockInstanceFormBuilder $form,
        BlockFormBuilder $block,
        ExtensionCollection $extensions,
        $area
    ) {

        /* @var BlockExtension $extension */
        if (!$extension = $extensions->get($this->request->get('extension'))) {
            abort(400, 'You must specify a block extension.');
        }

        $block->setExtension($extension);

        /* @var AreaInterface $area */
        if (!$area = $this->dispatch(new GetArea($area))) {
            abort(404);
        }

        $field = $area->getField('blocks');

        $block->setArea($area);
        $block->setField($field);

        $form->setOption('title', $area->getTitle());
        $form->setOption('description', $area->getDescription());

        $form->on(
            'saving_block',
            function () use ($form, $block) {
                if ($entry = $form->getChildFormEntry('entry')) {
                    $block->setFormEntryAttribute(
                        'entry',
                        $entry
                    );
                }
            }
        );

        $form->addForm('block', $block);

        $extension->extend($form);

        return $form->render();
    }

    /**
     * Return a list of blocks to view.
     *
     * @param BlockRepositoryInterface $blocks
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function choose(ExtensionCollection $extensions)
    {

        /* @var ExtensionCollection $extensions */
        $extensions = $extensions
            ->search('anomaly.module.blocks::block.*')
            ->enabled()
            ->sort();

        return $this->view->make(
            'anomaly.module.blocks::admin/blocks/choose',
            [
                'extensions' => $extensions->all(),
            ]
        );
    }

    /**
     * Edit an existing entry.
     *
     * @param BlockInstanceFormBuilder $form
     * @param BlockFormBuilder $block
     * @param BlockRepositoryInterface $blocks
     * @param $area
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        BlockInstanceFormBuilder $form,
        BlockFormBuilder $block,
        BlockRepositoryInterface $blocks,
        $area,
        $id
    ) {

        /* @var BlockInterface $entry */
        if (!$entry = $blocks->find($id)) {
            abort(404);
        }

        $block->setEntry($entry);

        /* @var AreaInterface $area */
        $area = $entry->getArea();

        $form->setOption('title', $area->getTitle());
        $form->setOption('description', $area->getDescription());

        /* @var BlockExtension $extension */
        $extension = $entry->extension();

        $form->addForm('block', $block);

        $extension->extend($form);

        return $form->render($id);
    }
}
