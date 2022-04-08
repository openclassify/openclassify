<?php namespace Anomaly\FilesModule\File\Command;


/**
 * Class GetSystemMaxUploadSize
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetSystemMaxUploadSize
{

    /**
     * Handle the command.
     *
     * @return int
     */
    public function handle()
    {
        $post = $this->getSize('post_max_size');
        $file = $this->getSize('upload_max_filesize');

        return $file > $post ? $post : $file;
    }

    /**
     * Get php.ini value and convert it to Mb if needed.
     *
     * @param $key
     * @return float|int
     */
    protected function getSize($key)
    {
        preg_match('/([0-9]*)(K|M|G)?/im', ini_get($key), $matches);

        if ($matches[2] === 'G') {
            return $matches[1] * 1024;
        }

        if ($matches[2] === 'M') {
            return $matches[1];
        }

        if ($matches[2] === 'K') {
            return $matches[1] / 1024;
        }

        return $matches[1] / (1024 * 1024);
    }
}
