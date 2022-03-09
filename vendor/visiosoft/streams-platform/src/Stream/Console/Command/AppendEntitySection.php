<?php namespace Anomaly\Streams\Platform\Stream\Console\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Support\Writer;

/**
 * Class AppendEntitySection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AppendEntitySection
{

    /**
     * The entity slug.
     *
     * @var string
     */
    protected $slug;

    /**
     * The addon instance.
     *
     * @var Addon
     */
    protected $addon;

    /**
     * The entity stream namespace.
     *
     * @var string
     */
    protected $namespace;

    /**
     * Create a new WriteEntityModel instance.
     *
     * @param Addon $addon
     * @param       $slug
     * @param       $namespace
     */
    public function __construct(Addon $addon, $slug, $namespace)
    {
        $this->slug      = $slug;
        $this->addon     = $addon;
        $this->namespace = $namespace;
    }

    /**
     * Handle the command.
     *
     * @param Writer $writer
     */
    public function handle(Writer $writer)
    {
        $singular = str_singular($this->slug);

        $slug = studly_case($this->addon->getSlug());
        $type = studly_case($this->addon->getType());

        $path = $this->addon->getPath("src/{$slug}{$type}.php");

        $section = "        '{$this->slug}' => [\n";
        $section .= "            'buttons' => [\n";
        $section .= "                'new_{$singular}',\n";
        $section .= "            ],\n";
        $section .= "        ],\n";

        // Write sections.
        $writer->replace(
            $path,
            '/protected \$sections = \[\]/i',
            "protected \$sections = [\n    ]"
        );

        $writer->append(
            $path,
            '/protected \$sections = \[(?:.*\],)?\n(?<!    \];)/s',
            $section
        );
    }
}
