<?php namespace Anomaly\FilesModule\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileRotator
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileRotator
{

    /**
     * Rotate the uploaded file appropriately.
     *
     * @param  UploadedFile $file
     * @return UploadedFile
     */
    public function rotate(UploadedFile $file)
    {
        if (!function_exists('exif_read_data') || !exif_imagetype($file->getRealPath()) !== IMAGETYPE_JPEG) {
            return $file;
        }

        if (!$exif = exif_read_data($file->getRealPath())) {
            return $file;
        }

        if (($orientation = array_get($exif, 'Orientation')) && $orientation > 1) {
            $file = $this->orientate($file, $orientation);
        }

        return $file;
    }

    /**
     * Orientate the image.
     *
     * @param  UploadedFile $file
     * @param               $orientation
     * @return UploadedFile
     */
    protected function orientate(UploadedFile $file, $orientation)
    {
        $image = imagecreatefromjpeg($file->getRealPath());

        switch ($orientation) {

            case 2:
                imageflip($image, IMG_FLIP_HORIZONTAL);
                break;

            case 3:
                $image = imagerotate($image, 180, 0);
                break;

            case 4:
                $image = imagerotate($image, 180, 0);
                imageflip($image, IMG_FLIP_HORIZONTAL);
                break;

            case 5:
                $image = imagerotate($image, -90, 0);
                imageflip($image, IMG_FLIP_HORIZONTAL);
                break;

            case 6:
                $image = imagerotate($image, -90, 0);
                break;

            case 7:
                $image = imagerotate($image, 90, 0);
                imageflip($image, IMG_FLIP_HORIZONTAL);
                break;

            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }

        imagejpeg($image, $file->getRealPath(), 90);

        return new UploadedFile(
            $file->getRealPath(),
            $file->getClientOriginalName(),
            $file->getMimeType(),
            $file->getSize()
        );
    }
}
