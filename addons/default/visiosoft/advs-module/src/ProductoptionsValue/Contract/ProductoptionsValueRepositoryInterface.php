<?php namespace Visiosoft\AdvsModule\ProductoptionsValue\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface ProductoptionsValueRepositoryInterface extends EntryRepositoryInterface
{
	public function getWithOptionsId(array $ids);
    public function searchByOption($option, $value);
}
