<?php namespace Anomaly\UsersModule\User\Password\Command;

use Anomaly\UsersModule\User\Password\ForgotPasswordFormBuilder;
use Illuminate\Contracts\Config\Repository;

/**
 * Class SetDefaultOptions
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SetOptions
{

    /**
     * The reset form builder.
     *
     * @var ForgotPasswordFormBuilder
     */
    protected $builder;

    /**
     * Create a new SetDefaultOptions instance.
     *
     * @param ForgotPasswordFormBuilder $builder
     */
    public function __construct(ForgotPasswordFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param Repository $config
     */
    public function handle(Repository $config)
    {
        if (!$this->builder->getOption('redirect')) {
            $this->builder->setOption('redirect', '/');
        }

        if (!$this->builder->getOption('success_message')) {
            $this->builder->setOption(
                'success_message',
                'You are now logged in.'
            );
        }

        if (!$this->builder->getOption('container_class')) {
            $this->builder->setOption('container_class', 'form-wrapper');
        }
    }

}
