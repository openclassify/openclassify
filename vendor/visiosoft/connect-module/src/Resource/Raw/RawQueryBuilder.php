<?php

namespace Visiosoft\ConnectModule\Resource\Raw;

class RawQueryBuilder
{
    protected $raw;

    protected $count;

    public function __construct($raw, $count)
    {
        $this->raw = $raw;
        $this->count = $count;
    }

    public function count()
    {
        return $this->count;
    }

    public function raw()
    {
        return $this->raw;
    }
}
