<?php namespace Anomaly\Streams\Platform\Exception;

use Throwable;

/**
 * Class ExceptionIdentifier
 *
 * This is adopted from the excellent
 * Laravel-Exceptions package by @GrahamCampbell
 *
 * @link   http://pyrocms.com/
 * @author Graham Campbell https://github.com/GrahamCampbell
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ExceptionIdentifier
{

    /**
     * The identification mappings.
     *
     * @var string[]
     */
    protected $identification = [];

    /**
     * Identify the given exception.
     *
     * @param Throwable $exception
     *
     * @return string
     */
    public function identify(Throwable $exception)
    {
        $hash = spl_object_hash($exception);

        // if we know about the exception, return it's id
        if (isset($this->identification[$hash])) {
            return $this->identification[$hash];
        }

        // cleanup in preparation for the identification
        if (count($this->identification) >= 16) {
            array_shift($this->identification);
        }

        // generate, store, and return the id
        return $this->identification[$hash] = $this->generate();
    }

    /**
     * Generate a new uuid.
     *
     * We're generating uuids according to the official v4 spec.
     *
     * @return string
     */
    protected function generate()
    {
        $hash = bin2hex(random_bytes(16));

        $timeHi = hexdec(substr($hash, 12, 4)) & 0x0fff;
        $timeHi &= ~(0xf000);
        $timeHi |= 4 << 12;

        $clockSeqHi = hexdec(substr($hash, 16, 2)) & 0x3f;
        $clockSeqHi &= ~(0xc0);
        $clockSeqHi |= 0x80;

        $params = [
            substr($hash, 0, 8),
            substr($hash, 8, 4),
            sprintf('%04x', $timeHi),
            sprintf('%02x', $clockSeqHi),
            substr($hash, 18, 2),
            substr($hash, 20, 12),
        ];

        return vsprintf('%08s-%04s-%04s-%02s%02s-%012s', $params);
    }

}
