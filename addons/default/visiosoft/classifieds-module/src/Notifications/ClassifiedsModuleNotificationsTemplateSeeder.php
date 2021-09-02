<?php namespace Visiosoft\ClassifiedsModule\Notifications;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Str;
use Visiosoft\NotificationsModule\Template\Command\CreateTemplate;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;


class ClassifiedsModuleNotificationsTemplateSeeder extends Seeder
{
    use DispatchesJobs;
    public function run()
    {
        if (is_module_installed('visiosoft.module.notifications')) {

            $templates = [
                [
                    'en' => [
                        'message' => '<p><strong>Your post <a href="{url}" target="_blank">{name}</a> has been created successfully.</strong></p>',
                        'name' => 'Created Classified',
                        'greeting' => 'Hi',
                        'subject' => 'Created Classified'
                    ],
                    'stream' => 'classifieds',
                    'slug' => Str::slug('Created Classified', '_')
                ],
                [
                    'en' => [
                        'message' => '<p><strong>Your classified for<a href="{url}" target="_blank">{name}</a>has been approved.</strong></p>',
                        'name' => 'Approved Classified',
                        'greeting' => 'Hi',
                        'subject' => 'Approved Classified'
                    ],
                    'stream' => 'classifieds',
                    'slug' => Str::slug('Approved Classified', '_')
                ],
                [
                    'en' => [
                        'message' => '<p><strong>Your <a href="{url}" target="_blank">{name}</a>classified was rejected because it does not comply with the posting rules.</strong></p>',
                        'name' => 'Declined Classified',
                        'greeting' => 'Hi',
                        'subject' => 'Declined Classified'
                    ],
                    'stream' => 'classifieds',
                    'slug' => Str::slug('Declined Classified', '_')
                ],
                [
                    'en' => [
                        'message' => '<p><strong>You must confirm your <a href="{url}" target="_blank">{name}</a>posting to be published.</strong></p>',
                        'name' => 'Pending User Classified',
                        'greeting' => 'Hi',
                        'subject' => 'Pending User Classified'
                    ],
                    'stream' => 'classifieds',
                    'slug' => Str::slug('Pending User Classified', '_')
                ],
                [
                    'en' => [
                        'message' => '<p><strong>Your <a href="{url}" target="_blank">{name}</a> post is checked by our editors.</strong></p>',
                        'name' => 'Pending Classified',
                        'greeting' => 'Hi',
                        'subject' => 'Pending Classified'
                    ],
                    'stream' => 'classifieds',
                    'slug' => Str::slug('Pending Classified', '_')
                ]
            ];

            foreach ($templates as $template) {
                $this->dispatchNow(new CreateTemplate($template));
            }

        }
    }
}