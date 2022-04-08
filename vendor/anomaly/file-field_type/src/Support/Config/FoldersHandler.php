<?php namespace Anomaly\FileFieldType\Support\Config;

use Anomaly\CheckboxesFieldType\CheckboxesFieldType;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

/**
 * Class FoldersHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FoldersHandler
{

    /**
     * Handle the options.
     *
     * @param CheckboxesFieldType $fieldType
     * @param FolderRepositoryInterface $folders
     */
    public function handle(CheckboxesFieldType $fieldType, FolderRepositoryInterface $folders)
    {
        $fieldType->setOptions($folders->all()->pluck('name', 'id')->all());
    }
}
