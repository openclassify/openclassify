<?php namespace Visiosoft\ConnectModule\Command;

class CheckRequiredParams
{
    protected $required_params;

    protected $params;

    public function __construct(array $required_params, array $params)
    {
        $this->required_params = $required_params;
        $this->params = $params;

    }

    public function handle()
    {
        foreach ($this->required_params as $required) {
            if (!array_key_exists($required, $this->params)) {
                throw new \Exception(trans('visiosoft.module.connect::message.required_parameter', ['parameter' => $required]));
                die;
            }
        }
    }
}