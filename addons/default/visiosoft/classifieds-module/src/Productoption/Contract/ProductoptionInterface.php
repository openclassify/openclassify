<?php namespace Visiosoft\ClassifiedsModule\Productoption\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface ProductoptionInterface extends EntryInterface
{
	public function getName();
}
