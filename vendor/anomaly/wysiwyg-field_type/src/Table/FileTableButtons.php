<?php namespace Anomaly\WysiwygFieldType\Table;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\Streams\Platform\Application\Application;

/**
 * Class FileTableButtons
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileTableButtons
{

    /**
     * Handle the table buttons.
     *
     * @param FileTableBuilder $builder
     * @param Application $application
     */
    public function handle(FileTableBuilder $builder, Application $application)
    {
        $segment = "app/{$application->getReference()}/files-module";

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
