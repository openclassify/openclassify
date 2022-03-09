<?php namespace Anomaly\WysiwygFieldType\Table;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\Streams\Platform\Application\Application;

/**
 * Class UploadTableButtons
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UploadTableButtons
{

    /**
     * Handle the table buttons.
     *
     * @param Application $application
     * @param UploadTableBuilder $builder
     */
    public function handle(Application $application, UploadTableBuilder $builder)
    {
        $builder->setButtons(
            [
                'select' => [
                    'data-select' => $builder->getMode(),
                    'data-entry'  => function (FileInterface $entry) {
                        return $entry->path();
                    },
                ],
            ]
        );
    }
}
