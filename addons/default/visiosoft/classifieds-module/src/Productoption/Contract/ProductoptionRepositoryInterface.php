<?php namespace Visiosoft\ClassifiedsModule\Productoption\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface ProductoptionRepositoryInterface extends EntryRepositoryInterface
{
	public function getWithCategoryId($id);
}
