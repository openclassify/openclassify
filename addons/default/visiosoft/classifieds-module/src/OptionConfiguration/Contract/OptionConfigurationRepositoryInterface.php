<?php namespace Visiosoft\ClassifiedsModule\OptionConfiguration\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface OptionConfigurationRepositoryInterface extends EntryRepositoryInterface
{
	public function createConfigration($classifiedid,$price,$currency,$stock,$option_json);

	public function getConf($classifiedid);

	public function getUnusedConfigs();

	public function deleteUnusedConfigs($classifiedsIDs);

	public function deleteClassifiedsConfigs($adID);

    public function deleteConfig($id);
}
