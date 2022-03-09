<?php namespace Anomaly\FilesModule\Folder\Command;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class CreateStream
{

    use DispatchesJobs;

    /**
     * The file folder instance.
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Create a new CreateStream instance.
     *
     * @param FolderInterface $folder
     */
    public function __construct(FolderInterface $folder)
    {
        $this->folder = $folder;
    }

    /**
     * Handle the command.
     *
     * @param StreamRepositoryInterface $streams
     * @param Repository                $config
     */
    public function handle(StreamRepositoryInterface $streams, Repository $config)
    {
        $streams->create(
            [
                $config->get('app.fallback_locale') => [
                    'name'        => $this->folder->getName(),
                    'description' => $this->folder->getDescription(),
                ],
                'slug'                              => $this->folder->getSlug(),
                'namespace'                         => 'files',
                'translatable'                      => true,
                'trashable'                         => true,
                'locked'                            => false,
            ]
        );
    }
}
