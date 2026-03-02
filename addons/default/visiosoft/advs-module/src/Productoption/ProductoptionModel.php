<?php namespace Visiosoft\AdvsModule\Productoption;

use Visiosoft\AdvsModule\Productoption\Contract\ProductoptionInterface;
use Anomaly\Streams\Platform\Model\Advs\AdvsProductoptionsEntryModel;

class ProductoptionModel extends AdvsProductoptionsEntryModel implements ProductoptionInterface
{
	public function getName()
	{
		return $this->name;
	}
}
