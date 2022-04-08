<?php namespace Anomaly\FilesFieldType\Validation;

use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;


/**
 * Class ValidateDisk
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ValidateDisk
{


    /**
     * Handle the validation.
     *
     * @param  FormBuilder             $builder
     * @param  DiskRepositoryInterface $disks
     * @param                          $attribute
     * @return bool
     */
    public function handle(FormBuilder $builder, DiskRepositoryInterface $disks, $attribute)
    {
        $fieldType = $builder->getFormField($attribute);

        $disk = array_get($fieldType->getConfig(), 'disk');

        if (is_numeric($disk) && !$disks->find($disk)) {
            return false;
        }

        if (!is_numeric($disk) && !$disks->findBySlug($disk)) {
            return false;
        }

        return true;
    }
}
