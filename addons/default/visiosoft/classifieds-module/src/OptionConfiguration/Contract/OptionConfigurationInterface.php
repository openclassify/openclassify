<?php namespace Visiosoft\ClassifiedsModule\OptionConfiguration\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface OptionConfigurationInterface extends EntryInterface
{
	public function getName($add_name = true);
}
