<?php namespace Visiosoft\SinglefileFieldType\Command;

use Visiosoft\SinglefileFieldType\SinglefileFieldType;
use Illuminate\Http\Request;

/**
 * Class GetUploadFile
 *
 * @link          http://openclassify.com/
 * @author        OpenClassify, Inc. <support@openclassify.com>
 * @author        Visiosoft Inc <support@openclassify.com>
 */
class GetUploadFile
{

    /**
     * The field type instance.
     *
     * @var SinglefileFieldType
     */
    protected $fieldType;

    /**
     * Create a new GetUploadFile instance.
     *
     * @param SinglefileFieldType $fieldType
     */
    public function __construct(SinglefileFieldType $fieldType)
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
