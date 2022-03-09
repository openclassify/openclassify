<?php namespace Anomaly\ContactPlugin\Form\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Support\Parser;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Mail\Message;

/**
 * Class BuildMessage
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class BuildMessage
{

    /**
     * The message object.
     *
     * @var Message
     */
    protected $message;

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new BuildMessage instance.
     *
     * @param Message     $message
     * @param FormBuilder $builder
     */
    public function __construct(Message $message, FormBuilder $builder)
    {
        $this->message = $message;
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param  SettingRepositoryInterface  $settings
     * @param  Parser                      $parser
     */
    public function handle(SettingRepositoryInterface $settings, Parser $parser)
    {
        $input = $this->builder->getFormValues()->all();

        call_user_func_array(
            [$this->message, 'to'],
            $parser->parse(
                (array)$this->builder->getOption(
                    'to',
                    $settings->get(
                        'streams::contact_email',
                        env('CONTACT_EMAIL', env('ADMIN_EMAIL'))
                    )
                ),
                $input
            )
        );

        if ($cc = (array)$this->builder->getOption('cc', null)) {
            call_user_func_array(
                [$this->message, 'cc'],
                $parser->parse($cc, $input)
            );
        }

        if ($bcc = (array)$this->builder->getOption('bcc', null)) {
            call_user_func_array(
                [$this->message, 'bcc'],
                $parser->parse($bcc, $input)
            );
        }

        call_user_func_array(
            [$this->message, 'from'],
            $parser->parse(
                (array)$this->builder->getOption(
                    'from',
                    $settings->get(
                        'streams::server_email',
                        'noreply@localhost.com'
                    )
                ),
                $input
            )
        );

        call_user_func_array(
            [$this->message, 'subject'],
            (array)$parser->parse(
                $this->builder->getOption('subject', 'Contact Request'),
                $input
            )
        );
    }
}
