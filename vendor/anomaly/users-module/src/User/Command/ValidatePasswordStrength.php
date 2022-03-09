<?php namespace Anomaly\UsersModule\User\Command;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Validation\Validator;

/**
 * Class ValidatePasswordStrength
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ValidatePasswordStrength
{

    /**
     * The password in question.
     *
     * @var string
     */
    protected $password;

    /**
     * Create a new ValidatePasswordStrength instance.
     *
     * @param $password
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Handle the command.
     *
     * @param Repository $config
     * @return Validator
     */
    public function handle(Repository $config)
    {
        $factory = app('validator');

        $requirements = $config->get(
            'anomaly.module.users::password.requirements',
            [
                '[a-z]',
                '[A-Z]',
            ]
        );

        /* @var Validator $validator */
        $validator = $factory->make(
            [
                'password' => $this->password,
            ],
            [
                'password' => array_merge(
                    [
                        'min:' . $config->get('anomaly.module.users::password.minimum_length'),
                    ],
                    array_map(
                        function ($requirement) {
                            return 'regex:/' . $requirement . '/';
                        },
                        $requirements
                    )
                ),
            ]
        );
        
        if (!$validator->passes()) {

            $failed = array_filter(
                $requirements,
                function ($pattern) {
                    return !(bool)preg_match('/' . $pattern . '/', $this->password);
                }
            );

            $validator->errors()->merge(
                array_map(
                    function ($requirement) {
                        return trans('anomaly.module.users::setting.password_requirements.option.' . $requirement);
                    },
                    array_intersect($requirements, $failed)
                )
            );
        }

        return $validator;
    }
}
