<?php

namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Command\GetType;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Support\Decorator;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Intervention\Image\Constraint;

/**
 * Class FilePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FilePresenter extends EntryPresenter
{

    use DispatchesJobs;

    /**
     * The decorated object.
     * This is for IDE support.
     *
     * @var FileInterface
     */
    protected $object;

    /**
     * The URL generator.
     *
     * @var UrlGenerator
     */
    protected $url;

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new FilePresenter instance.
     *
     * @param UrlGenerator $url
     * @param Request      $request
     * @param Repository   $config
     * @param              $object
     */
    public function __construct(UrlGenerator $url, Request $request, Repository $config, $object)
    {
        $this->url     = $url;
        $this->config  = $config;
        $this->request = $request;

        parent::__construct($object);
    }

    /**
     * Return the size label.
     *
     * @deprecated since v2.2 use "entry.label(entry.dimensions)"
     * @return null|string
     */
    public function sizeLabel()
    {
        if (!$dimensions = $this->dimensions()) {
            return null;
        }

        return $this->label($dimensions, 'info');
    }

    /**
     * Return the image dimensions.
     *
     * @return null|string
     */
    public function dimensions()
    {
        $extension = $this->object->getExtension();

        /**
         * Only images can provide sizes.
         */
        if (!in_array($extension, config('anomaly.module.files::mimes.thumbnails'))) {
            return null;
        }

        /**
         * Except SVGs.. they're spooky.
         */
        if ($extension == 'svg') {
            return null;
        }

        return $this->object->getWidth() . ' x ' . $this->object->getHeight();
    }

    /**
     * Return the size in a readable format.
     *
     * @deprecated since v2.2 use "size($unit, $decimals)";
     * @param  string $unit
     * @param  int    $decimals
     * @return string
     */
    public function readableSize($unit = null, $decimals = 2)
    {
        return $this->size($unit, $decimals);
    }

    /**
     * Return the size in a readable format.
     *
     * @param  string $unit
     * @param  int    $decimals
     * @return string
     */
    public function size($unit = null, $decimals = 2)
    {
        $bytes = $this->object->getSize();

        if (!$unit) {

            $size = ['B', 'KB', 'MB', 'GB'];

            $factor = floor((strlen($bytes) - 1) / 3);

            return (float) sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . @$size[(int) $factor];
        }

        if ($bytes >= 1 << 30 || $unit == "GB" || $unit == "G") {
            return number_format($bytes / (1 << 30), 2) . " {$unit}";
        }

        if ($bytes >= 1 << 20 || $unit == "MB" || $unit == "M") {
            return number_format($bytes / (1 << 20), 2) . " {$unit}";
        }

        if ($bytes >= 1 << 10 || $unit == "KB" || $unit == "K") {
            return number_format($bytes / (1 << 10), 2) . " {$unit}";
        }

        return number_format($bytes) . " B";
    }

    /**
     * Return a file preview.
     *
     * @param  int $width
     * @param  int $height
     * @return string
     */
    public function preview($width = 64, $height = 64)
    {
        if ($this->type() == 'image' && $this->object->canPreview()) {
            return $this->object->image()
                ->width($width . 'px')
                ->resize(
                    $width,
                    $height,
                    function (Constraint $constraint) {
                        $constraint->aspectRatio();
                    }
                )
                ->output();
        }

        $type = $this->dispatch(new GetType($this->object)) ?: 'document';

        return $this->image
            ->make('anomaly.module.files::img/types/' . $type . '.png')
            ->height($height)
            ->image();
    }

    /**
     * Return a file preview.
     *
     * @param  int $width
     * @param  int $height
     * @return string
     */
    public function thumbnail($width = 64, $height = 64)
    {
        if ($this->type() == 'image' && $this->object->canPreview()) {
            return $this->object->image()->fit($width, $height)->output();
        }

        $type = $this->dispatch(new GetType($this->object)) ?: 'document';

        return $this->image
            ->make('anomaly.module.files::img/types/' . $type . '.png')
            ->height($height)
            ->image();
    }

    /**
     * Return the view path for a file.
     *
     * @return string
     */
    public function viewPath()
    {
        return '/files/' . $this->object->path();
    }

    /**
     * Return the stream path for a file.
     *
     * @return string
     */
    public function streamPath()
    {
        return '/files/stream/' . $this->object->path();
    }

    /**
     * Return the download path for a file.
     *
     * @return string
     */
    public function downloadPath()
    {
        return '/files/download/' . $this->object->path();
    }

    /**
     * Catch calls to fields on
     * the file's related entry.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        $entry = $this->object->getEntry();

        if ($entry && $entry->hasField($key)) {
            return (new Decorator())->decorate($entry)->{$key};
        }

        return parent::__get($key);
    }
}
