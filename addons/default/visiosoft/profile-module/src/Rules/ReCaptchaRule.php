<?php namespace Visiosoft\ProfileModule\Rules;

use Anomaly\Streams\Platform\Message\MessageBag;
use ReCaptcha\ReCaptcha;

class ReCaptchaRule
{
    private $message;

    public function __construct(MessageBag $message)
    {
        $this->message = $message;
    }

    public function handle($attribute, $value)
    {
        if (empty($value)) {
            $this->message->error(trans('visiosoft.module.profile::message.recaptcha_field_is_required'));

            return false;
        }

        $recaptcha = new ReCaptcha(setting_value('visiosoft.module.profile::google_captcha_secret_key'));

        $resp = $recaptcha->setExpectedHostname(request()->server('SERVER_NAME'))
            ->setScoreThreshold(setting_value('visiosoft.module.profile::score_threshold'))
            ->verify($value, request()->server('REMOTE_ADDR'));

        if (!$resp->isSuccess()) {
            $this->message->error('visiosoft.module.profile::message.failed_to_validate_captcha');

            return false;
        }

        return true;
    }
}