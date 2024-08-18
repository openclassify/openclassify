<?php namespace Visiosoft\CustomfieldsModule\CustomField\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface CustomFieldInterface extends EntryInterface
{
    public function checkType($type);

    public function getType();

    public function isSortable();

    public function hasValues();

    public function getClassifiedValue($classifiedCF = null);
}
