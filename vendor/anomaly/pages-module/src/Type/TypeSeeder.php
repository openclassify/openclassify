<?php namespace Anomaly\PagesModule\Type;

use Anomaly\PagesModule\Type\Contract\TypeInterface;
use Anomaly\PagesModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

/**
 * Class TypeSeeder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TypeSeeder extends Seeder
{

    /**
     * The type repository.
     *
     * @var TypeRepositoryInterface
     */
    protected $types;

    /**
     * The field repository.
     *
     * @var FieldRepositoryInterface
     */
    protected $fields;

    /**
     * The streams repository.
     *
     * @var StreamRepositoryInterface
     */
    protected $streams;

    /**
     * The assignment repository.
     *
     * @var AssignmentRepositoryInterface
     */
    protected $assignments;

    /**
     * Create a new TypeSeeder instance.
     *
     * @param TypeRepositoryInterface       $types
     * @param FieldRepositoryInterface      $fields
     * @param StreamRepositoryInterface     $streams
     * @param AssignmentRepositoryInterface $assignments
     */
    public function __construct(
        TypeRepositoryInterface $types,
        FieldRepositoryInterface $fields,
        StreamRepositoryInterface $streams,
        AssignmentRepositoryInterface $assignments
    ) {
        $this->types       = $types;
        $this->fields      = $fields;
        $this->streams     = $streams;
        $this->assignments = $assignments;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        if ($type = $this->types->findBySlug('default_pages')) {
            $this->types->delete($type);
        }

        /* @var TypeInterface $type */
        $type = $this->types
            ->truncate()
            ->create(
                [
                    'en'           => [
                        'name'        => 'Default',
                        'description' => 'A simple page type.',
                    ],
                    'slug'         => 'default',
                    'handler'      => 'anomaly.extension.default_page_handler',
                    'theme_layout' => 'theme::layouts/default.twig',
                    'layout'       => '<h1>{{ page.title }}</h1>

{{ page.content.render|raw }}',
                ]
            );

        $stream = $type->getEntryStream();

        $this->assignments->create(
            [
                'translatable' => true,
                'stream'       => $stream,
                'field'        => $this->fields->findBySlugAndNamespace('content', 'pages'),
            ]
        );
    }
}
