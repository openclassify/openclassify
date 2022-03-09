<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Illuminate\Contracts\Config\Repository;

/**
 * Class GetType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetType
{

    /**
     * The file instance.
     *
     * @var FileInterface
     */
    protected $file;

    /**
     * Create a new GetType instance.
     *
     * @param FileInterface $file
     */
    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    /**
     * Handle the command.
     *
     * @param  Repository $config
     * @return int|null|string
     */
    public function handle(Repository $config)
    {
        foreach ($config->get('anomaly.module.files::mimes.types') as $type => $extensions) {
            if (in_array($this->file->getExtension(), $extensions)) {
                return $type;
            }
        }

        return null;
    }
}
