<?php namespace Visiosoft\AdvsModule\OptionConfiguration\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface OptionConfigurationRepositoryInterface extends EntryRepositoryInterface
{
	public function createConfigration($ad_id,$price,$currency,$stock,$option_json);

	public function getConf($ad_id);

	public function getUnusedConfigs();

	public function deleteUnusedConfigs($adsIDs);

	public function deleteAdsConfigs($adID);

    public function deleteConfig($id);
}
