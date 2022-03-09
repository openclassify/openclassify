<?php

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\FilesModule\Folder\FolderRepository;
use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class AnomalyModuleFilesAddStrIdToFolders
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleFilesAddStrIdToFolders extends Migration
{

    /**
     * Don't delete the stream.
     * Used for reference only.
     *
     * @var bool
     */
    protected $delete = false;

    /**
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'folders',
    ];

    /**
     * @var array
     */
    protected $assignments = [
        'str_id' => [
            'required' => true,
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up()
    {
        /**
         * Load the concrete on purpose.
         *
         * @var FolderRepositoryInterface $users
         */
        $folders = app(FolderRepository::class);

        /* @var FolderInterface|EloquentModel $folder */
        foreach ($folders->allWithTrashed() as $folder) {

            if ($folder->getStrId()) {
                continue;
            }

            $folders->withoutEvents(
                function () use ($folders, $folder) {
                    $folders->save($folder->setRawAttribute('str_id', str_random(24)));
                }
            );
        }

        $field      = $this->fields()->findBySlugAndNamespace('str_id', 'files');
        $stream     = $this->streams()->findBySlugAndNamespace('folders', 'files');
        $assignment = $this->assignments()->findByStreamAndField($stream, $field);

        $this->assignments()->save($assignment->setAttribute('unique', true));
    }

}
