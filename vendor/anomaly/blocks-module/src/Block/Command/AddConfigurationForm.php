<?php namespace Anomaly\BlocksModule\Block\Command;

use Anomaly\BlocksModule\Block\BlockExtension;
use Anomaly\BlocksModule\Block\Form\BlockInstanceFormBuilder;
use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Illuminate\Contracts\Config\Repository;

/**
 * Class AddConfigurationForm
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddConfigurationForm
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
     * @param ConfigurationFormBuilder $configuration
     * @param Repository               $config
     */
    public function handle(ConfigurationFormBuilder $configuration, Repository $config)
    {
        if (!$config->get($this->extension->getNamespace('configuration'))) {
            return;
        }

        $configuration->setOption('locking_enabled', false);
        $configuration->setEntry($this->extension->getNamespace());

        if ($block = $this->builder->getChildEntry('block')) {
            $configuration->setScope($block->getId());
        }

        $this->builder->addForm('configuration', $configuration);

        $this->builder->on(
            'saved_block',
            function () use ($configuration) {
                $configuration->setScope(
                    $this->builder->getChildFormEntryId('block')
                );
            }
        );
    }
}
