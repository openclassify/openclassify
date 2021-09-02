<?php namespace Visiosoft\ClassifiedsModule\Productoption;

use Visiosoft\ClassifiedsModule\Productoption\Contract\ProductoptionInterface;
use Anomaly\Streams\Platform\Model\Classifieds\ClassifiedsProductoptionsEntryModel;

class ProductoptionModel extends ClassifiedsProductoptionsEntryModel implements ProductoptionInterface
{
	public function getName()
	{
		return $this->name;
	}
}
