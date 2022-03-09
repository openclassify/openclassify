<?php namespace Anomaly\FileFieldType\Command;

use Anomaly\FileFieldType\FileFieldType;
use Illuminate\Http\Request;

/**
 * Class GetUploadFile
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetUploadFile
{

    /**
     * The field type instance.
     *
     * @var FileFieldType
     */
    protected $fieldType;

    /**
     * Create a new GetUploadFile instance.
     *
     * @param FileFieldType $fieldType
     */
    public function __construct(FileFieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Handle the command.
     *
     * @param  Request                                                   $request
     * @return array|\Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public function handle(Request $request)
    {
        return $request->file($this->fieldType->getInputName());
    }
}
