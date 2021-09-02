<?php namespace Visiosoft\ClassifiedsModule\ProductoptionsValue;

use Visiosoft\ClassifiedsModule\ProductoptionsValue\Contract\ProductoptionsValueInterface;
use Anomaly\Streams\Platform\Model\Classifieds\ClassifiedsProductoptionsValueEntryModel;

class ProductoptionsValueModel extends ClassifiedsProductoptionsValueEntryModel implements ProductoptionsValueInterface
{
	public function getName()
	{
		return $this->name;
	}
}
