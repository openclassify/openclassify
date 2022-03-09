<?php namespace Anomaly\PostsModule\Type\Command;

use Anomaly\PostsModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddTypeMetadata
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddTypeMetadata
{

    use DispatchesJobs;

    /**
     * The type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Create a new AddTypeMetadata instance.
     *
     * @param TypeInterface $type
     */
    public function __construct(TypeInterface $type)
    {
        $this->type = $type;
    }

    /**
     * Handle the command.
     *
     * @param ViewTemplate $template
     */
    public function handle(ViewTemplate $template)
    {
        $template->set('meta_title', $this->type->getMetaTitle());
        $template->set('meta_description', $this->type->getMetaDescription());
    }
}
