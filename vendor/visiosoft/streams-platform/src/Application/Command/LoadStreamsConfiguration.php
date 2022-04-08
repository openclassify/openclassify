<?php namespace Anomaly\Streams\Platform\Application\Command;

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Support\Configurator;

class LoadStreamsConfiguration
{

    /**
     * Handle the command.
     *
     * @param Configurator $configurator
     * @param Application  $application
     */
    public function handle(Configurator $configurator, Application $application)
    {
        // Load package configuration.
        $configurator->addNamespace('streams', realpath(__DIR__ . '/../../../resources/config'));

        // Load application overrides.
        $configurator->addNamespaceOverrides('streams', $application->getResourcesPath('streams/config'));

        // Load system overrides.
        $configurator->addNamespaceOverrides('streams', base_path('resources/streams/config'));
    }
}
