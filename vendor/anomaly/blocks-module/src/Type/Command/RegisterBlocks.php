<?php namespace Anomaly\BlocksModule\Type\Command;

use Anomaly\BlocksModule\Block\BlockExtension;
use Anomaly\BlocksModule\Block\Form\BlockFormBuilder;
use Anomaly\BlocksModule\Type\Contract\TypeInterface;
use Anomaly\BlocksModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class RegisterBlocks
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RegisterBlocks
{

    /**
     * Handle the command.
     *
     * @param AddonCollection         $addons
     * @param TypeRepositoryInterface $types
     * @param ExtensionCollection     $extensions
     */
    public function handle(
        AddonCollection $addons,
        TypeRepositoryInterface $types,
        ExtensionCollection $extensions
    ) {

        /**
         * Register Custom Block Types
         *
         * @var TypeInterface $type
         */
        foreach ($types->all() as $type) {

            $extension = new BlockExtension();

            $extension
                ->setEnabled(true)
                ->setInstalled(true)
                ->setType('extension')
                ->setVendor('anomaly')
                ->setName($type->getName())
                ->setTitle($type->getName())
                ->setCategory($type->getCategory())
                ->setSlug($type->getSlug() . '_block')
                ->setModel($type->getEntryModelName())
                ->setView($type->getContentLayoutView())
                ->setDescription($type->getDescription())
                ->setWrapper($type->getWrapperLayoutView())
                ->setPath(realpath(__DIR__ . '/../../../'))
                ->setProvides('anomaly.module.blocks::block.' . $type->getSlug());

            $extension->on(
                'extending',
                function (MultipleFormBuilder $builder) use ($type) {

                    $builder->setOption('block_type', $type->getId());

                    /* @var BlockFormBuilder $block */
                    $block = $builder->getChildForm('block');

                    $block->setType($type);
                }
            );

            $addons->put($extension->getNamespace(), $extension);
            $extensions->put($extension->getNamespace(), $extension);
        }
    }
}
