<?php namespace Visiosoft\ConnectModule\Resource\Component\Result\Contract;

use Illuminate\Support\Collection;

/**
 * Interface ResultInterface
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Result\Contract
 */
interface ResultInterface
{

    /**
     * Set the result formatters.
     *
     * @param $formatters
     * @return $this
     */
    public function setFormatters(Collection $formatters);

    /**
     * Get the result formatters.
     *
     * @return mixed
     */
    public function getFormatters();

    /**
     * Set the result entry.
     *
     * @param $entry
     * @return $this
     */
    public function setEntry($entry);

    /**
     * Get the result entry.
     *
     * @return mixed
     */
    public function getEntry();
}
