<?php

if (!function_exists('max_upload_size')) {

    /**
     * Return the max upload size
     * available on the system.
     *
     * @return string
     */
    function max_upload_size()
    {
        $post = str_replace('M', '', ini_get('post_max_size'));
        $file = str_replace('M', '', ini_get('upload_max_filesize'));

        return $file > $post ? $post : $file;
    }
}
