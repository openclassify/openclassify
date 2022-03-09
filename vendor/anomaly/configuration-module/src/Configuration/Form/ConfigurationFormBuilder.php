<?php namespace Anomaly\ConfigurationModule\Configuration\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ConfigurationFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ConfigurationFormBuilder extends FormBuilder
{

    /**
     * The configuration scope.
     *
     * @var null|string
     */
    protected $scope = null;

    /**
     * No model needed.
     *
     * @var bool
     */
    protected $model = false;

    /**
     * The form fields.
     *
     * @var ConfigurationFormFields
     */
    protected $fields = ConfigurationFormFields::class;

    /**
     * The form actions handler.
     *
     * @var string
     */
    protected $actions = [
        'save',
    ];

    /**
     * The form buttons handler.
     *
     * @var string
     */
    protected $buttons = [
        'cancel',
    ];

    /**
     * Fired when the builder is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getScope() && !$this->getEntry()) {
            throw new \Exception('The $scope parameter is required when creating configuration.');
        }
    }

    /**
     * Get the scope.
     *
     * @return null|string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set the scope.
     *
     * @param $scope
     * @return $this
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }
}
