<?php namespace Anomaly\EncryptedFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Illuminate\Encryption\Encrypter;

/**
 * Class EncryptedFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class EncryptedFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The encrypter utility.
     *
     * @var Encrypter
     */
    protected $encrypter;

    /**
     * Create a new EncryptedFieldTypePresenter instance.
     *
     * @param $object
     */
    public function __construct($object)
    {
        // Workaround for deprecated class in 5.1
        $this->encrypter = app('Illuminate\Encryption\Encrypter');

        parent::__construct($object);
    }

    /**
     * Decrypt the value.
     *
     * @return string
     */
    public function decrypt()
    {
        if (!$value = $this->object->getValue()) {
            return null;
        }

        // Return the value if it's already decoded.
        if (array_get($this->object->getConfig(), 'auto_decrypt') === true) {
            return $value;
        }

        try {
            return $this->encrypter->decrypt($value);
        } catch (\Exception $e) {
            return $value; // Caution.
        }
    }

    /**
     * Alias for decrypt()
     *
     * @return string
     * @deprecated since version 2.0
     */
    public function decrypted()
    {
        return $this->decrypt();
    }

    /**
     * Hash the value.
     *
     * @return string
     */
    public function hash($algorithm = 'md5')
    {
        if (!$value = $this->object->getValue()) {
            return null;
        }

        return hash($algorithm, $this->decrypt());
    }

    /**
     * Alias for hash('md5')
     *
     * @return string
     */
    public function md5()
    {
        return $this->hash('md5');
    }

    /**
     * Alias for hash('sha1')
     *
     * @return string
     */
    public function sha1()
    {
        return $this->hash('sha1');
    }

    /**
     * Alias for hash('sha256')
     *
     * @return string
     */
    public function sha256()
    {
        return $this->hash('sha256');
    }

    /**
     * Return the contextual value.
     * This is the most basic usable form
     * of the value for this field type.
     *
     * @return string
     */
    public function __value()
    {
        return $this->decrypt();
    }
}
