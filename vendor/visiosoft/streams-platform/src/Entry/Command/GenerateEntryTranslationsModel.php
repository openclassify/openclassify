<?php namespace Anomaly\Streams\Platform\Entry\Command;

use Anomaly\Streams\Platform\Support\Parser;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Entry\Parser\EntryNamespaceParser;
use Anomaly\Streams\Platform\Entry\Parser\EntryTranslationsClassParser;
use Anomaly\Streams\Platform\Entry\Parser\EntryTranslationsTableParser;

class GenerateEntryTranslationsModel
{

    /**
     * The stream interface.
     *
     * @var StreamInterface
     */
    protected $stream;

    /**
     * Create a new GenerateEntryTranslationsModel instance.
     *
     * @param StreamInterface $stream
     */
    public function __construct(StreamInterface $stream)
    {
        $this->stream = $stream;
    }

    /**
     * Handle the comand.
     *
     * @param Parser      $parser
     * @param Application $application
     */
    public function handle(Parser $parser, Application $application)
    {
        $data = [
            'namespace' => (new EntryNamespaceParser())->parse($this->stream),
            'class'     => (new EntryTranslationsClassParser())->parse($this->stream),
            'table'     => (new EntryTranslationsTableParser())->parse($this->stream),
        ];

        $template = file_get_contents(__DIR__ . '/../../../resources/stubs/models/translation.stub');

        $path = $application->getStoragePath('models/' . studly_case($this->stream->getNamespace()));

        $path .= '/' . studly_case($this->stream->getNamespace()) . studly_case($this->stream->getSlug());

        $file = $path . 'EntryTranslationsModel.php';

        @unlink($file); // Don't judge me..

        file_put_contents($file, $parser->parse($template, $data));
    }
}
