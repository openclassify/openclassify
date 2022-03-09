<?php namespace Anomaly\BlocksModule\Block\Command;

use Anomaly\BlocksModule\Block\BlockExtension;
use Anomaly\BlocksModule\Block\Contract\BlockInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class MakeBlock
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MakeBlock
{

    use DispatchesJobs;

    /**
     * The block instance.
     *
     * @var BlockInterface
     */
    protected $block;
    
    /**
     * The block payload.
     *
     * @var array
     */
    protected $payload;

    /**
     * Create a new MakeBlock instance.
     *
     * @param BlockInterface $block
     * @param array $payload
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
     */
    public function handle(Factory $view)
    {
        /* @var BlockExtension $extension */
        $extension = $this->block->extension();

        $extension->fire(
            'load',
            [
                'block' => $this->block,
            ]
        );

        if (!$extension->getView()) {
            return;
        }
        
        $this->block->setContent(
            $view
                ->make(
                    $extension->getView(),
                    array_merge(['block' => $this->block], $this->payload)
                )
                ->render()
        );
    }
}
