<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Visiosoft\AdvsModule\Adv\Event\ChangedStatusAd;
use Visiosoft\PackagesModule\Package\PackageModel;

class UpdateClassifiedStatus
{
    use DispatchesJobs;

    protected $classified;
    protected $type;

    public function __construct($classified, $type)
    {
        $this->classified = $classified;
        $this->type       = $type;
    }

    public function handle()
    {
        $defaultClassifiedPublishTime = setting_value('visiosoft.module.advs::default_published_time');
        if (is_module_installed('visiosoft.module.packages')) {
            $packageModel = new PackageModel();
            if ($packagePublishedTime = $packageModel->reduceTimeLimit($this->classified->cat1)) {
                $defaultClassifiedPublishTime = $packagePublishedTime;
            }
        }

        switch ($this->type) {
            case 'approved':
                $update = [
                    'status' => 'approved',
                ];

                if (!setting_value('visiosoft.module.advs::show_finish_and_publish_date')) {
                    $update['publish_at'] = date('Y-m-d H:i:s');

                    if (is_null($this->classified->finish_at)) {
                        $update['finish_at'] = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . $defaultClassifiedPublishTime . ' day'));
                    }
                }

                $this->classified->update($update);

                break;
            default:
                $this->classified->update([
                    'status' => $this->type,
                ]);

                break;
        }

        event(new ChangedStatusAd($this->classified));
    }
}
