<?php namespace Anomaly\BlocksModule\Block;

use Anomaly\BlocksModule\Block\Contract\BlockInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class BlockCollection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BlockCollection extends EntryCollection
{

    use DispatchesJobs;

    /**
     * Return if the collection has a
     * block type or default to key.
     *
     * @param mixed $key
     * @return bool
     */
    public function has($key)
    {
        $item = $this->first(
            function ($block) use ($key) {

                /* @var BlockInterface $block */
                return str_is($key, $block->getExtensionSlug()) || str_is($key, $block->getExtensionNamespace());
            }
        );

        if ($item) {
            return true;
        }

        return parent::has($key);
    }

    /**
     * Return only blocks of a certain type.
     *
     * @param mixed $key
     * @return $this
     */
    public function type($key)
    {
        return $this->filter(
            function ($block) use ($key) {

                /* @var BlockInterface $block */
                return str_is($key, $block->getExtensionSlug()) || str_is($key, $block->getExtensionNamespace());
            }
        );
    }

    /**
     * Render the blocks.
     *
     * @param array $payload
     * @return string
     */
    public function render(array $payload = [])
    {
        return implode(
            "\n\n",
            $this->undecorate()->map(
                function (BlockInterface $block) use ($payload) {
                    return $block->render($payload);
                }
            )->all()
        );
    }

    /**
     * Return the string value.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
