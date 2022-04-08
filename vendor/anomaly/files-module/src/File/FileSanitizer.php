<?php namespace Anomaly\FilesModule\File;

/**
 * Class FileSanitizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FileSanitizer
{

    /**
     * Clean a file name for safe usage.
     *
     * @param $name
     * @return mixed|string
     */
    static public function clean($name)
    {
        if (!env('CLEAN_FILE_NAMES', true)) {
            return $name;
        }
        
        $name = rawurldecode($name);

        // sanitize filename
        $name = preg_replace(
            '~
            [<>:"/\\|?*]|            # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
            [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
            [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
            [#\[\]@!$&\'()+,;=]|     # URI reserved https://tools.ietf.org/html/rfc3986#section-2.2
            [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
            ~x',
            '-',
            $name
        );

        /**
         * Avoid ".", ".." or ".hiddenFiles"
         */
        $name = ltrim($name, '.-');

        return $name;
    }

}
