<?php namespace Anomaly\Streams\Platform;

/**
 * Class StreamsCompilerProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class StreamsCompilerProvider
{

    /**
     * Get files to compile during
     * Laravel's optimize command.
     *
     * @return array
     */
    public static function compiles()
    {
        return [

            // Models
            'vendor/visiosoft/streams-platform/src/Entry/EntryModel.php',
            'vendor/visiosoft/streams-platform/src/Field/FieldModel.php',
            'vendor/visiosoft/streams-platform/src/Stream/StreamModel.php',
            'vendor/visiosoft/streams-platform/src/Assignment/AssignmentModel.php',

            // Addons
            'vendor/visiosoft/streams-platform/src/Addon/Theme/Theme.php',
            'vendor/visiosoft/streams-platform/src/Addon/Module/Module.php',
            'vendor/visiosoft/streams-platform/src/Addon/Plugin/Plugin.php',
            'vendor/visiosoft/streams-platform/src/Addon/Extension/Extension.php',
            'vendor/visiosoft/streams-platform/src/Addon/FieldType/FieldType.php',

            // Addon Collections
            'vendor/visiosoft/streams-platform/src/Addon/Theme/ThemeCollection.php',
            'vendor/visiosoft/streams-platform/src/Addon/Module/ModuleCollection.php',
            'vendor/visiosoft/streams-platform/src/Addon/Plugin/PluginCollection.php',
            'vendor/visiosoft/streams-platform/src/Addon/Extension/ExtensionCollection.php',
            'vendor/visiosoft/streams-platform/src/Addon/FieldType/FieldTypeCollection.php',

            // Support
            'vendor/visiosoft/streams-platform/src/Support/Parser.php',
            'vendor/visiosoft/streams-platform/src/Support/Template.php',
            'vendor/visiosoft/streams-platform/src/Support/Observer.php',
            'vendor/visiosoft/streams-platform/src/Support/Resolver.php',
            'vendor/visiosoft/streams-platform/src/Support/Decorator.php',
            'vendor/visiosoft/streams-platform/src/Support/Evaluator.php',
            'vendor/visiosoft/streams-platform/src/Support/Authorizer.php',
            'vendor/visiosoft/streams-platform/src/Support/Translator.php',
            'vendor/visiosoft/streams-platform/src/Support/Configurator.php',

            // Miscellaneous
            'vendor/visiosoft/streams-platform/src/Http/Middleware/MiddlewareCollection.php',
            'vendor/visiosoft/streams-platform/src/Addon/Extension/ExtensionModel.php',
            'vendor/visiosoft/streams-platform/src/Addon/Module/ModuleModel.php',
            'vendor/visiosoft/streams-platform/src/View/ViewMobileOverrides.php',
            'vendor/visiosoft/streams-platform/src/Model/EloquentPresenter.php',
            'vendor/visiosoft/streams-platform/src/Addon/AddonIntegrator.php',
            'vendor/visiosoft/streams-platform/src/Entry/EntryPresenter.php',
            'vendor/visiosoft/streams-platform/src/Addon/AddonManager.php',
            'vendor/visiosoft/streams-platform/src/View/ViewOverrides.php',
        ];
    }
}
