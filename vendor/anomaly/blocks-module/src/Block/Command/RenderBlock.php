<?php namespace Anomaly\BlocksModule\Block\Command;

use Anomaly\BlocksModule\Block\BlockExtension;
use Anomaly\BlocksModule\Block\Contract\BlockInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RenderBlock
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RenderBlock
{

    use DispatchesJobs;

    /**
     * The block instance.
     *
     * @var BlockInterface
     */
    protected $block;

    /**
     * Additional view payload.
     *
     * @var array
     */
    protected $payload;

    /**
     * Create a new RenderBlock instance.
     *
     * @param BlockInterface $block
     */
    public function __construct(BlockInterface $block, array $payload = [])
    {
        $this->block   = $block;
        $this->payload = $payload;
    }

    /**
     * Handle the command.
     *
     * @param Factory $view
     * @return null|string
     */
    public function handle(Factory $view)
    {
        /* @var BlockExtension $extension */
        $extension = $this->block->extension();

        if (!$extension->getView()) {
            return null;
        }

        return $view->make(
            $extension->getWrapper(),
            array_merge(
                [
                    'block'   => $this->block,
                    'content' => $this->block->getContent(),
                ],
                $this->payload
            )
        )->render();
    }
}
