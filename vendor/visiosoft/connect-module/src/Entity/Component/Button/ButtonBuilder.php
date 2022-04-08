<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Button;

use Anomaly\Streams\Platform\Ui\Button\ButtonFactory;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ButtonBuilder
 *

 * @package Anomaly\Streams\Platform\Ui\Entity\Component\Button
 */
class ButtonBuilder
{

    /**
     * The input reader.
     *
     * @var ButtonInput
     */
    protected $input;

    /**
     * The button factory.
     *
     * @var ButtonFactory
     */
    protected $factory;

    /**
     * Create a new ButtonBuilder instance.
     *
     * @param ButtonInput   $input
     * @param ButtonFactory $factory
     */
    public function __construct(ButtonInput $input, ButtonFactory $factory)
    {
        $this->input   = $input;
        $this->factory = $factory;
    }

    /**
     * Build the buttons.
     *
     * @param EntityBuilder $builder
     */
    public function build(EntityBuilder $builder)
    {
        $this->input->read($builder);

        foreach ($builder->getButtons() as $button) {

            if (array_get($button, 'enabled', true)) {

                $button = $this->factory->make($button);

                $button->setSize('sm');

                $builder->addEntityButton($button);
            }
        }
    }
}
