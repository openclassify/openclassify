<?php namespace Visiosoft\AdvsModule\SmsSeeder;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Str;
use Visiosoft\SmsModule\Template\Command\SmsTemplateCreator;

class SmsSeeder extends Seeder
{
    use DispatchesJobs;

    public function run()
    {
        if (is_module_installed('visiosoft.module.sms')) {

            $templates = [
                [
                    'en' => [
                        'name' => 'Approved Ad',
                        'message' => "{url} ilanınız yayınlandı.",
                    ],
                    'slug' => Str::slug('Approved Ad', '_')
                ],
                [
                    'en' => [
                        'name' => 'Declined Ad',
                        'message' => "{url} ilanınız ilan verme kurallarına uymadığı için reddedilmiştir.",
                    ],
                    'slug' => Str::slug('Declined Ad', '_')
                ],
                [
                    'en' => [
                        'name' => 'Pending User Ad',
                        'message' => "{url} ilanınızı gözden geçirip onaylamanız gerekmektedir.",
                    ],
                    'slug' => Str::slug('Pending User Ad', '_')
                ],
                [
                    'en' => [
                        'name' => 'Pending Ad',
                        'message' => "{url} ilanınız editörlerimiz tarafından kontrol edilmektedir.",
                    ],
                    'slug' => Str::slug('Pending Ad', '_')
                ],
            ];

            foreach ($templates as $template) {
                $this->dispatchSync(new SmsTemplateCreator($template));
            }
        }
    }
}