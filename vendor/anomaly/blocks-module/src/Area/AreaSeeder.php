<?php namespace Anomaly\BlocksModule\Area;

use Anomaly\BlocksModule\Area\AreaRepository;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class AreaSeeder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AreaSeeder extends Seeder
{

    /**
     * The area repository.
     *
     * @var AreaRepository
     */
    protected $areas;

    /**
     * Create a new AreaSeeder instance.
     */
    public function __construct(AreaRepository $areas)
    {
        $this->areas = $areas;

        parent::__construct();
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        if (!$this->areas->findBySlug('footer')) {
            $this->areas->create(
                [
                    'en' => [
                        'name'        => 'Footer',
                        'description' => 'Add blocks here to display in your footer.',
                    ],
                ]
            );
        }
    }
}
