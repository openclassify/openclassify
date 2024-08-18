<?php namespace Visiosoft\AdvsModule\Notifications;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Str;
use Visiosoft\NotificationsModule\Template\Command\CreateTemplate;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;


class AdvsModuleNotificationsTemplateSeeder extends Seeder
{
    use DispatchesJobs;
    public function run()
    {
        if (is_module_installed('visiosoft.module.notifications')) {

            $templates = [
                [
                    'en' => [
                        'message' => '<p><strong>Your post <a href="{url}" target="_blank">{name}</a> has been created successfully.</strong></p>',
                        'name' => 'Created Ad',
                        'greeting' => 'Hi',
                        'subject' => 'Created Ad'
                    ],
                    'stream' => 'advs',
                    'slug' => Str::slug('Created Ad', '_')
                ],
                [
                    'en' => [
                        'message' => '<p><strong>Your ad for<a href="{url}" target="_blank">{name}</a>has been approved.</strong></p>',
                        'name' => 'Approved Ad',
                        'greeting' => 'Hi',
                        'subject' => 'Approved Ad'
                    ],
                    'stream' => 'advs',
                    'slug' => Str::slug('Approved Ad', '_')
                ],
                [
                    'en' => [
                        'message' => '<p><strong>Your <a href="{url}" target="_blank">{name}</a>ad was rejected because it does not comply with the posting rules.</strong></p>',
                        'name' => 'Declined Ad',
                        'greeting' => 'Hi',
                        'subject' => 'Declined Ad'
                    ],
                    'stream' => 'advs',
                    'slug' => Str::slug('Declined Ad', '_')
                ],
                [
                    'en' => [
                        'message' => '<p><strong>You must confirm your <a href="{url}" target="_blank">{name}</a>posting to be published.</strong></p>',
                        'name' => 'Pending User Ad',
                        'greeting' => 'Hi',
                        'subject' => 'Pending User Ad'
                    ],
                    'stream' => 'advs',
                    'slug' => Str::slug('Pending User Ad', '_')
                ],
                [
                    'en' => [
                        'message' => '<p><strong>Your <a href="{url}" target="_blank">{name}</a> post is checked by our editors.</strong></p>',
                        'name' => 'Pending Ad',
                        'greeting' => 'Hi',
                        'subject' => 'Pending Ad'
                    ],
                    'stream' => 'advs',
                    'slug' => Str::slug('Pending Ad', '_')
                ]
            ];

            foreach ($templates as $template) {
                $this->dispatchSync(new CreateTemplate($template));
            }

        }
    }
}