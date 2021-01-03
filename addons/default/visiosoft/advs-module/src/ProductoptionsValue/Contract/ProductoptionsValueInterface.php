<?php namespace Visiosoft\AdvsModule\ProductoptionsValue\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface ProductoptionsValueInterface extends EntryInterface
{
	public function getName();
}
