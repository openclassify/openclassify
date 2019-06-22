<?php namespace Visiosoft\SinglefileFieldType\Support\Config;

use Anomaly\CheckboxesFieldType\CheckboxesFieldType;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

/**
 * Class FoldersHandler
 *
 * @link   http://openclassify.com/
 * @author OpenClassify, Inc. <support@openclassify.com>
 * @author Visiosoft Inc <support@openclassify.com>
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
