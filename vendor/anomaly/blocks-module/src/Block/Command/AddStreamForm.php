<?php namespace Anomaly\BlocksModule\Block\Command;

use Anomaly\BlocksModule\Block\BlockExtension;
use Anomaly\BlocksModule\Block\Form\BlockInstanceFormBuilder;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Contracts\Container\Container;

/**
 * Class AddStreamForm
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddStreamForm
{

    /**
     * The block form builder.
     *
     * @var BlockInstanceFormBuilder
     */
    protected $builder;

    /**
     * The block extension.
     *
     * @var BlockExtension
     */
    protected $extension;

    /**
     * Create a new GetBlockStream instance.
     *
     * @param BlockInstanceFormBuilder $builder
     * @param BlockExtension           $extension
     */
    public function __construct(BlockInstanceFormBuilder $builder, BlockExtension $extension)
    {
        $this->builder   = $builder;
        $this->extension = $extension;
    }

    /**
     * Handle the command.
     *
     * @param Container $container
     */
    public function handle(Container $container)
    {
        if (!$stream = $this->extension->stream()) {
            return;
        }

        /* @var FormBuilder $form */
        $form = $container->make($this->extension->getForm());

        $form->setOption('locking_enabled', false);
        $form->setModel($this->extension->getModel());
        $form->setEntry($this->extension->getBlockEntryId());

        $this->builder->addForm('entry', $form, 0);
    }
}
