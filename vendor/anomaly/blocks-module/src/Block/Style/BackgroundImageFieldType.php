<?php namespace Anomaly\BlocksModule\Block\Style;

use Anomaly\BlocksModule\Block\Traits\ProvidesStyle;
use Anomaly\FileFieldType\FileFieldType;
use Anomaly\FilesModule\File\Command\GetFile;
use Anomaly\FilesModule\File\Contract\FileInterface;

/**
 * Class BackgroundImageFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BackgroundImageFieldType extends FileFieldType
{

    use ProvidesStyle;

    /**
     * The required flag.
     *
     * @var bool
     */
    protected $required = false;

    /**
     * The field type label.
     *
     * @var string
     */
    protected $label = 'anomaly.module.blocks::style.background_image.label';

    /**
     * Return the CSS style.
     *
     * @param null $default
     * @return string
     */
    public function css($default = null)
    {
        $value = $default;

        /* @var FileInterface $file */
        if ($file = $this->dispatch(new GetFile(parent::getValue()))) {
            $value = 'url(' . $file->make()->path() . ')';
        }

        return 'background-image: ' . $value . ';';
    }

}
