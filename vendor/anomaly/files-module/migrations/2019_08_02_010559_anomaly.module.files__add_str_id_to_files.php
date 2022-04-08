<?php

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\FileRepository;
use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\Streams\Platform\Entry\Command\AutoloadEntryModels;

/**
 * Class AnomalyModuleFilesAddStrIdToFiles
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleFilesAddStrIdToFiles extends Migration
{
    use DispatchesJobs;

    /**
     * Don't delete the stream.
     * Used for reference only.
     *
     * @var bool
     */
    protected $delete = false;

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'str_id' => 'anomaly.field_type.text',
    ];

    /**
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'files',
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
         * Make sure that the File entry model has been loaded before we attempt to interact with it.
         */
        $this->dispatchNow(new AutoloadEntryModels());


        /**
         * Load the concrete on purpose.
         *
         * @var FileRepositoryInterface $users
         */
        $files = app(FileRepository::class);

        /* @var FileInterface|EloquentModel $file */
        foreach ($files->allWithTrashed() as $file) {

            if ($file->getStrId()) {
                continue;
            }

            $files->withoutEvents(
                function () use ($files, $file) {
                    $files->save($file->setRawAttribute('str_id', str_random(24)));
                }
            );
        }

        $field      = $this->fields()->findBySlugAndNamespace('str_id', 'files');
        $stream     = $this->streams()->findBySlugAndNamespace('files', 'files');
        $assignment = $this->assignments()->findByStreamAndField($stream, $field);

        $this->assignments()->save($assignment->setAttribute('unique', true));
    }

}
