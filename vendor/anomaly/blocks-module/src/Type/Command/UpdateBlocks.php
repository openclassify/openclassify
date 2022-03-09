<?php namespace Anomaly\BlocksModule\Type\Command;

use Anomaly\BlocksModule\Block\Contract\BlockInterface;
use Anomaly\BlocksModule\Block\Contract\BlockRepositoryInterface;
use Anomaly\BlocksModule\Type\Contract\TypeInterface;
use Anomaly\BlocksModule\Type\Contract\TypeRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateBlocks
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UpdateBlocks
{

    use DispatchesJobs;

    /**
     * The block type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Update a new UpdateBlocks instance.
     *
     * @param TypeInterface $type
     */
    public function __construct(TypeInterface $type)
    {
        $this->type = $type;
    }

    /**
     * Handle the command.
     *
     * @param TypeRepositoryInterface $types
     * @param BlockRepositoryInterface $blocks
     */
    public function handle(TypeRepositoryInterface $types, BlockRepositoryInterface $blocks)
    {
        /* @var TypeInterface $type */
        if (!$type = $types->find($this->type->getId())) {
            return;
        }

        /* @var BlockInterface $block */
        foreach ($type->getBlocks() as $block) {
            $blocks->save($block->setAttribute('entry_type', $this->type->getEntryModelName()));
        }
    }
}
