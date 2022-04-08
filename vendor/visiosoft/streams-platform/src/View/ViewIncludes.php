<?php namespace Anomaly\Streams\Platform\View;

use Illuminate\Support\Collection;

/**
 * Class ViewIncludes
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ViewIncludes extends Collection
{

    /**
     * Add an include to a slot.
     *
     * @param $slot
     * @param $include
     * @return $this
     */
    public function include($slot, $include)
    {
        if (!$this->has($slot)) {
            $this->put($slot, new Collection());
        }

        /* @var Collection $includes */
        $includes = $this->get($slot);

        $includes->put($include, $include);

        return $this;
    }

    /**
     * Render an include slot.
     *
     * @param $slot
     * @return string
     */
    public function render($slot)
    {
        if (!$includes = $this->get($slot)) {
            return null;
        }

        return implode(
            "\n",
            array_map(
                function ($include) {
                    return view($include)->render();
                },
                $includes->all()
            )
        );
    }
}
