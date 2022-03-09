<?php namespace Anomaly\MarkdownFieldType;

use Anomaly\MarkdownFieldType\Command\RenameDirectory;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Application\Application;

/**
 * Class MarkdownFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class MarkdownFieldType extends FieldType
{

    /**
     * The default input class.
     *
     * @var string
     */
    protected $class = '';

    /**
     * The database column type.
     *
     * @var string
     */
    protected $columnType = 'text';

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.markdown::input';

    /**
     * The application utility.
     *
     * @var Application
     */
    protected $application;

    /**
     * Create a new EditorFieldType instance.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [
        'height' => 300,
    ];

    /**
     * Get the file path.
     *
     * @return null|string
     */
    public function getFilePath()
    {
        return str_replace('storage::', '', $this->template->asset($this->getValue(), 'md'));
    }

    /**
     * Get the storage path.
     *
     * @return null|string
     */
    public function getStoragePath()
    {
        return $this->application->getStoragePath($this->getFilePath());
    }

    /**
     * Get the view path.
     *
     * @return string
     */
    public function getViewPath()
    {
        return 'storage::' . str_replace('.md', '', $this->getFilePath());
    }

    /**
     * Get the asset path.
     *
     * @return string
     */
    public function getAssetPath()
    {
        return 'storage::' . $this->getFilePath();
    }

    /**
     * Get the storage file name.
     *
     * @return string
     */
    public function getFileName()
    {
        return basename($this->getFilePath());
    }

}
