<?php namespace Anomaly\EncryptedFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;
use Illuminate\Encryption\Encrypter;

/**
 * Class EncryptedFieldTypeModifier
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class EncryptedFieldTypeModifier extends FieldTypeModifier
{

    /**
     * The encrypter utility.
     *
     * @var Encrypter
     */
    protected $encrypter;

    /**
     * Create a new EncryptedFieldTypeModifier instance.
     *
     * @param FieldType $fieldType
     */
    public function __construct(FieldType $fieldType)
    {
        // Workaround for deprecated class in 5.1
        $this->encrypter = app('Illuminate\Encryption\Encrypter');
    }

    /**
     * Modify the value.
     *
     * @param $value
     * @return mixed
     */
    public function modify($value)
    {
        return $this->encrypter->encrypt($value);
    }

    /**
     * Restore the value.
     *
     * @param $value
     * @return string
     */
    public function restore($value)
    {
        if (!empty($value) && array_get($this->fieldType->getConfig(), 'auto_decrypt') === true) {
            try {
                return $this->encrypter->decrypt($value);
            } catch (\Exception $exception) {
                return $value;
            }
        }

        return $value;
    }
}
