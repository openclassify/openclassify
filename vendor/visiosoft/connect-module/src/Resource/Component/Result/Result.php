<?php namespace Visiosoft\ConnectModule\Resource\Component\Result;

use Visiosoft\ConnectModule\Resource\Component\Formatter\Formatter;
use Visiosoft\ConnectModule\Resource\Component\Result\Contract\ResultInterface;
use Visiosoft\ConnectModule\Resource\Resource;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Support\Collection;

/**
 * Class Result
 *
 * @package       Visiosoft\ConnectModule\Resource\Component\Result
 */
class Result implements ResultInterface
{

    /**
     * The result entry.
     *
     * @var mixed
     */
    protected $entry = null;

    /**
     * The result resource.
     *
     * @var null|Resource
     */
    protected $resource = null;

    /**
     * The result formatters.
     *
     * @var Collection
     */
    protected $formatters;

    /**
     * Set the result formatters.
     *
     * @param Collection $formatters
     * @return $this
     */
    public function setFormatters(Collection $formatters)
    {
        $this->formatters = $formatters;

        return $this;
    }

    /**
     * Get the result formatters.
     *
     * @return mixed
     */
    public function getFormatters()
    {
        return $this->formatters;
    }

    /**
     * Get the resource.
     *
     * @return Resource|null
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set the resource.
     *
     * @param Resource $resource
     * @return $this
     */
    public function setResource(Resource $resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Set the result entry.
     *
     * @param $entry
     * @return $this
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * Get the result entry.
     *
     * @return mixed|EloquentModel
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Return an array.
     */
    public function toArray()
    {
        if ($this->entry instanceof EloquentModel) {
            $entry = $this->entry->toArrayForApi();
        } else {
            $entry = $this->entry;
        }

        /* @var Formatter $formatter */
        foreach ($this->getFormatters() as $formatter) {
            $entry[$formatter->getField()] = $formatter->getOutput();
        }

        return $entry;
    }
}
