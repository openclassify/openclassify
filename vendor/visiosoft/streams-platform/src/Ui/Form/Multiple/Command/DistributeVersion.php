<?php namespace Anomaly\Streams\Platform\Ui\Form\Multiple\Command;

use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Anomaly\Streams\Platform\Version\Contract\VersionInterface;

/**
 * Class DistributeVersion
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class DistributeVersion
{

    /**
     * The form builder.
     *
     * @var MultipleFormBuilder
     */
    protected $builder;

    /**
     * The version instance.
     *
     * @var VersionInterface
     */
    protected $version;

    /**
     * Create a new BuildFormColumnsCommand instance.
     *
     * @param MultipleFormBuilder $builder
     * @param VersionInterface $version
     */
    public function __construct(MultipleFormBuilder $builder, VersionInterface $version)
    {
        $this->builder = $builder;
        $this->version = $version;
    }

    /**
     * Set the form model object from the builder's model.
     */
    public function handle()
    {
        if (request()->method() == 'POST') {
            return;
        }

        if (!$version = request('version')) {
            return;
        }

        $this->builder->fire(
            'versioning',
            [
                'builder' => $this->builder,
                'version' => $this->version,
            ]
        );
    }
}
