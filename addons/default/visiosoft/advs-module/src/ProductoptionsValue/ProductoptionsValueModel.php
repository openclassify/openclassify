<?php namespace Visiosoft\AdvsModule\ProductoptionsValue;

use Visiosoft\AdvsModule\ProductoptionsValue\Contract\ProductoptionsValueInterface;
use Anomaly\Streams\Platform\Model\Advs\AdvsProductoptionsValueEntryModel;

class ProductoptionsValueModel extends AdvsProductoptionsValueEntryModel implements ProductoptionsValueInterface
{
	public function getName()
	{
		return $this->name;
	}
}
