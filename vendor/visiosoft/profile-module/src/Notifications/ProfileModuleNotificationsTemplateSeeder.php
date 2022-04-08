<?php namespace Visiosoft\ProfileModule\Notifications;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Str;
use Visiosoft\NotificationsModule\Template\Command\CreateTemplate;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;


class ProfileModuleNotificationsTemplateSeeder extends Seeder
{
    use DispatchesJobs;
    public function run()
    {
        if (is_module_installed('visiosoft.module.notifications')) {

            $templates = [
                [
                    'en' => [
                        'message' => '<p><strong>Your membership is activated.<br>Email:{email}</strong></p>',
                        'name' => 'Registered User',
                        'greeting' => 'Hi {first_name}',
                        'subject' => 'Your Membership Has Been Successfully Created!'
                    ],
                    'stream' => 'users',
                    'slug' => Str::slug('Registered User', '_')
                ],
                [
                    'en' => [
                        'message' => '<tr>
                                     <td class="esd-structure es-p20t es-p20b es-p20r es-p20l" align="left">
                                         <table width="100%" cellspacing="0" cellpadding="0">
                                             <tbody>
                                             <tr>
                                                 <td class="esd-container-frame" width="560" valign="top" align="center">
                                                     <table width="100%" cellspacing="0" cellpadding="0">
                                                         <tbody>
                                                         <tr>
                                                             <td class="esd-block-text es-m-txt-l es-p15t es-p15b es-m-p15t es-m-p0b es-m-p0r es-m-p0l" align="left">
                                                                 <h2 style="font-size: 26px;"><strong>Welcome to openclassify</strong></h2>
                                                             </td>
                                                         </tr>
                                                         <tr>
                                                             <td class="esd-block-text es-p20t" align="left">
                                                                 <p style="color: #707070; font-size: 16px;">Hi user,</p>
                                                             </td>
                                                         </tr>
                                                         <tr>
                                                             <td class="esd-block-text es-p15t" align="left">
                                                                 <p style="color: #707070; font-size: 16px;"></p>
                                                             </td>
                                                         </tr>
                                                         <tr>
                                                             <td align="center" class="esd-block-spacer" height="29"></td>
                                                         </tr>
                                                         <tr>
                                                             <td align="center" class="esd-block-button es-p10"><span class="es-button-border" style="border-bottom-width: 0px; background: #ffb600; border-radius: 4px;"><a href class="es-button" target="_blank" style="background: #ffb600; border-color: #ffb600; border-radius: 4px; font-size: 16px;"></a></span></td>
                                                         </tr>
                                                         <tr>
                                                             <td align="center" class="esd-block-spacer es-p20" style="font-size:0">
                                                                 <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
                                                                     <tbody>
                                                                     <tr>
                                                                         <td style="border-bottom: 0px solid #cccccc; background: none; height: 1px; width: 100%; margin: 0px;"></td>
                                                                     </tr>
                                                                     </tbody>
                                                                 </table>
                                                             </td>
                                                         </tr>
                                                         </tbody>
                                                     </table>
                                                 </td>
                                             </tr>
                                             </tbody>
                                         </table>
                                     </td>
                                 </tr>',
                        'name' => 'New User Welcome',
                        'subject' => 'Welcome | Openclassify.com'
                    ],
                    'stream' => 'users',
                    'slug' => Str::slug('New User Welcome', '_')
                ],
                [
                    'en' => [
                        'message' => '<tr>
                                     <td class="esd-structure es-p20t es-p20b es-p20r es-p20l" align="left">
                                         <table width="100%" cellspacing="0" cellpadding="0">
                                             <tbody>
                                             <tr>
                                                 <td class="esd-container-frame" width="560" valign="top" align="center">
                                                     <table width="100%" cellspacing="0" cellpadding="0">
                                                         <tbody>
                                                         <tr>
                                                             <td class="esd-block-text es-m-txt-l es-p15t es-p15b es-m-p15t es-m-p0b es-m-p0r es-m-p0l" align="left">
                                                                 <h2 style="font-size: 26px;"><strong>Forgot your password?</strong></h2>
                                                             </td>
                                                         </tr>
                                                         <tr>
                                                             <td class="esd-block-text es-p20t" align="left">
                                                                 <p style="color: #707070; font-size: 16px;">Hi user,</p>
                                                             </td>
                                                         </tr>
                                                         <tr>
                                                             <td align="center" class="esd-block-spacer" height="29"></td>
                                                         </tr>
                                                         <tr>
                                                             <td align="center" class="esd-block-button es-p10"><span class="es-button-border" style="border-bottom-width: 0px; background: #ffb600; border-radius: 4px;"><a href class="es-button" target="_blank" style="background: #ffb600; border-color: #ffb600; border-radius: 4px; font-size: 16px;">CHANGE PASSWORD</a></span></td>
                                                         </tr>
                                                         <tr>
                                                             <td align="center" class="esd-block-text">
                                                                 <p style="font-size: 11px; color: #707070;">Did you remember your password?<a target="_blank" style="font-size: 11px; ">Try logging in</a></p>
                                                             </td>
                                                         </tr>
                                                         <tr>
                                                             <td align="center" class="esd-block-spacer es-p20" style="font-size:0">
                                                                 <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
                                                                     <tbody>
                                                                     <tr>
                                                                         <td style="border-bottom: 0px solid #cccccc; background: none; height: 1px; width: 100%; margin: 0px;"></td>
                                                                     </tr>
                                                                     </tbody>
                                                                 </table>
                                                             </td>
                                                         </tr>
                                                         </tbody>
                                                     </table>
                                                 </td>
                                             </tr>
                                             </tbody>
                                         </table>
                                     </td>
                                 </tr>',
                        'name' => 'Password Forget',
                        'subject' => 'Forgot Your Password | Openclassify.com'
                    ],
                    'stream' => 'users',
                    'slug' => Str::slug('Password Forget', '_')
                ],
                [
                    'en' => [
                        'message' => '<p><strong>Your password has been changed</strong></p>',
                        'name' => 'Password Changed',
                        'greeting' => 'Hi',
                        'subject' => 'Password changed'
                    ],
                    'stream' => 'users',
                    'slug' => 'password_changed'
                ],

            ];

            foreach ($templates as $template) {
                $this->dispatchNow(new CreateTemplate($template));
            }
        }
    }
}