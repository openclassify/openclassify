<?php namespace Anomaly\TagsFieldType\Command;



/**
 * Class ParseOptions
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ParseOptions
{

    /**
     * The string options.
     *
     * @var string
     */
    protected $options;

    /**
     * Create a new ParseOptions instance.
     *
     * @param $options
     */
    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * Handle the command.
     *
     * @return array
     */
    public function handle()
    {
        $options = [];

        foreach (explode("\n", $this->options) as $option) {
            $options[] = ltrim(trim($option));
        }

        return array_filter($options);
    }
}
