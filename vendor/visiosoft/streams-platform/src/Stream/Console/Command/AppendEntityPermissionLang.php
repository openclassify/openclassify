<?php namespace Anomaly\Streams\Platform\Stream\Console\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonPermissionLang;
use Anomaly\Streams\Platform\Support\Writer;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AppendEntityPermissionLang
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AppendEntityPermissionLang
{

    use DispatchesJobs;

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
     * Create a new WriteEntityModel instance.
     *
     * @param Addon $addon
     * @param       $slug
     */
    public function __construct(Addon $addon, $slug)
    {
        $this->slug  = $slug;
        $this->addon = $addon;
    }

    /**
     * Handle the command.
     *
     * @param Writer $writer
     * @param Filesystem $files
     */
    public function handle(Writer $writer, Filesystem $files)
    {

        if (!$files->exists($path = $this->addon->getPath("resources/lang/en/permission.php"))) {
            $this->dispatchNow(new WriteAddonPermissionLang($this->addon->getPath()));
        }

        $human = humanize($this->slug);

        $name = ucfirst($human);

        $permissions = "    '{$this->slug}' => [\n";
        $permissions .= "        'name'   => '{$name}',\n";
        $permissions .= "        'option' => [\n";
        $permissions .= "            'read'   => 'Can read {$human}?',\n";
        $permissions .= "            'write'  => 'Can create/edit {$human}?',\n";
        $permissions .= "            'delete' => 'Can delete {$human}?',\n";
        $permissions .= "        ],\n";
        $permissions .= "    ],\n";

        $writer->replace(
            $path,
            '/return \[\];/i',
            "return [\n];"
        );

        $writer->prepend(
            $path,
            '/];/i',
            $permissions
        );
    }
}
